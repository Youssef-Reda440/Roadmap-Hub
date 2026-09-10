<?php

use App\Models\Category;
use App\Models\CreatorApplication;
use App\Models\Report;
use App\Models\Roadmap;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

function adminUser(): User
{
    return User::factory()->create(['role' => 'admin']);
}

function category(): Category
{
    $category = new Category;
    $category->name = fake()->unique()->word();
    $category->slug = Str::slug($category->name);
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

function creatorApplication(User $user, string $status = 'pending'): CreatorApplication
{
    $application = new CreatorApplication;
    $application->user_id = $user->id;
    $application->status = $status;
    $application->save();

    return $application;
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

test('admin can update another user without affecting administrator role integrity', function () {
    $admin = adminUser();
    $learner = User::factory()->create(['role' => 'learner']);

    $this->actingAs($admin)
        ->patch("/admin/users/{$learner->id}", [
            'name' => 'Updated Learner',
            'email' => 'updated.learner@example.com',
            'role' => 'creator',
        ])
        ->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'id' => $learner->id,
        'name' => 'Updated Learner',
        'email' => 'updated.learner@example.com',
        'role' => 'creator',
    ]);
    expect($admin->fresh()->role)->toBe('admin');
});

test('admin creates categories with a generated unique slug and validates duplicate names', function () {
    $admin = adminUser();

    $this->actingAs($admin)
        ->post('/admin/categories', [
            'name' => 'Web Development',
            'description' => 'Frontend and backend web skills.',
        ])
        ->assertSessionHas('success');

    $this->assertDatabaseHas('categories', [
        'name' => 'Web Development',
        'slug' => 'web-development',
    ]);

    $this->post('/admin/categories', ['name' => 'Web-Development'])
        ->assertSessionHas('success');

    $this->assertDatabaseHas('categories', [
        'name' => 'Web-Development',
        'slug' => 'web-development-2',
    ]);

    $this->post('/admin/categories', ['name' => 'Web Development'])
        ->assertSessionHasErrors('name');
});

test('admin updates category slugs and cannot delete categories linked to roadmaps', function () {
    $admin = adminUser();
    $category = category();

    $this->actingAs($admin)
        ->patch("/admin/categories/{$category->id}", [
            'name' => 'Backend Development',
            'description' => 'Server-side development skills.',
        ])
        ->assertSessionHas('success');

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Backend Development',
        'slug' => 'backend-development',
    ]);

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

test('admin can approve a pending learner creator application only once', function () {
    $admin = adminUser();
    $learner = User::factory()->create(['role' => 'learner']);
    $application = creatorApplication($learner);

    $this->actingAs($admin)
        ->patch("/admin/creator-applications/{$application->id}/approve")
        ->assertSessionHas('success');

    expect($application->fresh()->status)->toBe('approved');
    expect($learner->fresh()->role)->toBe('creator');

    $this->patch("/admin/creator-applications/{$application->id}/reject")
        ->assertSessionHas('error');
    expect($application->fresh()->status)->toBe('approved');
});

test('admin cannot approve a rejected creator application', function () {
    $admin = adminUser();
    $learner = User::factory()->create(['role' => 'learner']);
    $application = creatorApplication($learner);

    $this->actingAs($admin)
        ->patch("/admin/creator-applications/{$application->id}/reject")
        ->assertSessionHas('success');

    $this->patch("/admin/creator-applications/{$application->id}/approve")
        ->assertSessionHas('error');

    expect($application->fresh()->status)->toBe('rejected');
    expect($learner->fresh()->role)->toBe('learner');
});

test('admin does not downgrade ineligible creator applicants', function () {
    $reviewingAdmin = adminUser();
    $adminApplicant = User::factory()->create(['role' => 'admin']);
    $creatorApplicant = User::factory()->create(['role' => 'creator']);
    $adminApplication = creatorApplication($adminApplicant);
    $creatorApplication = creatorApplication($creatorApplicant);

    $this->actingAs($reviewingAdmin)
        ->patch("/admin/creator-applications/{$adminApplication->id}/approve")
        ->assertSessionHas('error');

    $this->patch("/admin/creator-applications/{$creatorApplication->id}/approve")
        ->assertSessionHas('error');

    expect($adminApplication->fresh()->status)->toBe('pending');
    expect($creatorApplication->fresh()->status)->toBe('pending');
    expect($adminApplicant->fresh()->role)->toBe('admin');
    expect($creatorApplicant->fresh()->role)->toBe('creator');
});

test('admin can approve or reject pending roadmaps only once', function () {
    $admin = adminUser();
    $pendingRoadmap = roadmap();
    $secondPendingRoadmap = roadmap();

    $this->actingAs($admin)
        ->patch("/admin/roadmap-reviews/{$pendingRoadmap->id}/approve")
        ->assertSessionHas('success');

    expect($pendingRoadmap->fresh()->status)->toBe('published');

    $this->patch("/admin/roadmap-reviews/{$pendingRoadmap->id}/reject")
        ->assertSessionHas('error');

    $this->patch("/admin/roadmap-reviews/{$secondPendingRoadmap->id}/reject")
        ->assertSessionHas('success');
    expect($secondPendingRoadmap->fresh()->status)->toBe('rejected');

    $this->patch("/admin/roadmap-reviews/{$secondPendingRoadmap->id}/approve")
        ->assertSessionHas('error');
    expect($secondPendingRoadmap->fresh()->status)->toBe('rejected');
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
