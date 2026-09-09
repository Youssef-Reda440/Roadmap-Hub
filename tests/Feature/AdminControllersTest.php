<?php

use App\Models\Category;
use App\Models\CreatorApplication;
use App\Models\Report;
use App\Models\Roadmap;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function adminUser(): User
{
    return User::factory()->create(['role' => 'admin']);
}

function category(): Category
{
    $category = new Category;
    $category->name = fake()->unique()->word();
    $category->save();

    return $category;
}

function roadmap(string $status = 'pending_review'): Roadmap
{
    $roadmap = new Roadmap;
    $roadmap->creator_id = User::factory()->create(['role' => 'creator'])->id;
    $roadmap->category_id = category()->id;
    $roadmap->title = fake()->sentence();
    $roadmap->description = fake()->paragraph();
    $roadmap->level = 'beginner';
    $roadmap->status = $status;
    $roadmap->save();

    return $roadmap;
}

test('non admins cannot access any administration section', function (string $uri) {
    $learner = User::factory()->create(['role' => 'learner']);

    $this->actingAs($learner)
        ->get($uri)
        ->assertForbidden();
})->with([
    '/admin/dashboard',
    '/admin/users',
    '/admin/creator-applications',
    '/admin/roadmap-reviews',
    '/admin/categories',
    '/admin/reports',
    '/admin/profile',
]);

test('admin dashboard supplies platform metrics', function () {
    $admin = adminUser();
    User::factory()->create(['role' => 'creator']);
    roadmap();

    $this->actingAs($admin)
        ->get('/admin/dashboard')
        ->assertOk()
        ->assertViewHas('totalCreators', 2)
        ->assertViewHas('totalRoadmaps', 1)
        ->assertViewHas('pendingRoadmaps', 1);
});

test('admin can search and filter users', function () {
    $admin = adminUser();
    $creator = User::factory()->create(['name' => 'Specific Creator', 'role' => 'creator']);
    User::factory()->create(['name' => 'Other Learner', 'role' => 'learner']);

    $this->actingAs($admin)
        ->get('/admin/users?search=Specific&role=creator')
        ->assertOk()
        ->assertViewHas('users', fn ($users) => $users->total() === 1 && $users->first()->is($creator));
});

test('admin cannot remove their own or the final administrator role', function () {
    $admin = adminUser();

    $this->actingAs($admin)
        ->patch("/admin/users/{$admin->id}", [
            'name' => $admin->name,
            'email' => $admin->email,
            'role' => 'learner',
        ])
        ->assertSessionHas('error');

    expect($admin->fresh()->role)->toBe('admin');
});

test('category creation validates uniqueness and deletion protects related roadmaps', function () {
    $admin = adminUser();
    $category = category();

    $this->actingAs($admin)
        ->post('/admin/categories', ['name' => $category->name])
        ->assertSessionHasErrors('name');

    $roadmap = new Roadmap;
    $roadmap->creator_id = User::factory()->create(['role' => 'creator'])->id;
    $roadmap->category_id = $category->id;
    $roadmap->title = 'Protected roadmap';
    $roadmap->description = 'Description';
    $roadmap->level = 'beginner';
    $roadmap->status = 'draft';
    $roadmap->save();

    $this->delete("/admin/categories/{$category->id}")
        ->assertSessionHas('error');

    $this->assertDatabaseHas('categories', ['id' => $category->id]);
});

test('admin can decide a pending creator application only once', function () {
    $admin = adminUser();
    $learner = User::factory()->create(['role' => 'learner']);
    $application = new CreatorApplication;
    $application->user_id = $learner->id;
    $application->status = 'pending';
    $application->save();

    $this->actingAs($admin)
        ->patch("/admin/creator-applications/{$application->id}/approve")
        ->assertSessionHas('success');

    expect($application->fresh()->status)->toBe('approved');
    expect($learner->fresh()->role)->toBe('creator');

    $this->patch("/admin/creator-applications/{$application->id}/reject")
        ->assertSessionHas('error');
});

test('admin can publish or reject only pending roadmaps', function () {
    $admin = adminUser();
    $pendingRoadmap = roadmap();
    $draftRoadmap = roadmap('draft');

    $this->actingAs($admin)
        ->patch("/admin/roadmap-reviews/{$pendingRoadmap->id}/approve")
        ->assertSessionHas('success');

    expect($pendingRoadmap->fresh()->status)->toBe('published');

    $this->patch("/admin/roadmap-reviews/{$draftRoadmap->id}/reject")
        ->assertSessionHas('error');
    expect($draftRoadmap->fresh()->status)->toBe('draft');
});

test('admin can resolve a pending report only once', function () {
    $admin = adminUser();
    $report = new Report;
    $report->user_id = User::factory()->create(['role' => 'learner'])->id;
    $report->reportable_type = Roadmap::class;
    $report->reportable_id = roadmap('published')->id;
    $report->reason = 'Inaccurate content';
    $report->status = 'pending';
    $report->save();

    $this->actingAs($admin)
        ->patch("/admin/reports/{$report->id}/resolve")
        ->assertSessionHas('success');

    expect($report->fresh()->status)->toBe('resolved');

    $this->patch("/admin/reports/{$report->id}/resolve")
        ->assertSessionHas('error');
});
