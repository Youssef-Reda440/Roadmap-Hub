<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Roadmap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoadmapController extends Controller
{
    public function index()
    {
        /** @var User $creator */
        $creator = Auth::user();

        $roadmaps = $creator->roadmaps()
            ->with('category')
            ->withCount('resources')
            ->latest()
            ->get();

        return view('creator.my-roadmaps', compact(
            'roadmaps'
        ));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('creator.roadmap-builder', compact(
            'categories'
        ));
    }

    public function store(Request $request)
    {
        /** @var User $creator */
        $creator = Auth::user();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'description' => [
                'required',
                'string',
            ],

            'level' => [
                'required',
                Rule::in([
                    'beginner',
                    'intermediate',
                    'advanced',
                ]),
            ],

            'action' => [
                'required',
                Rule::in([
                    'draft',
                    'submit',
                ]),
            ],

            'resources' => ['nullable', 'array'],

            'resources.*.title' => [
                'required',
                'string',
                'max:255',
            ],

            'resources.*.url' => [
                'required',
                'url',
                'max:2048',
            ],

            'resources.*.type' => [
                'required',
                Rule::in([
                    'video',
                    'documentation',
                    'article',
                    'link',
                    'other',
                ]),
            ],

            'resources.*.description' => [
                'required',
                'string',
            ],
        ]);

        $status = $validated['action'] === 'submit'
            ? 'pending_review'
            : 'draft';

        DB::transaction(function () use ($creator, $validated, $status) {

            $roadmap = $creator->roadmaps()->create([
                'category_id' => $validated['category_id'],
                'title' => $validated['title'],
                'description' => $validated['description'],
                'level' => $validated['level'],
                'status' => $status,
            ]);

            foreach ($validated['resources'] ?? [] as $resource) {
                $roadmap->resources()->create([
                    'title' => $resource['title'],
                    'url' => $resource['url'],
                    'type' => $resource['type'],
                    'description' => $resource['description'],
                ]);
            }
        });

        return redirect()
            ->route('creator.roadmaps.index')
            ->with(
                'success',
                $status === 'pending_review'
                    ? 'تم إرسال المسار للمراجعة بنجاح.'
                    : 'تم حفظ المسار كمسودة بنجاح.'
            );
    }

    public function edit(Roadmap $roadmap)
    {
        /** @var User $creator */
        $creator = Auth::user();

        abort_unless(
            $roadmap->creator_id === $creator->id,
            403
        );

        $roadmap->load([
            'category',
            'resources',
        ]);

        $categories = Category::orderBy('name')->get();

        return view('creator.roadmap-builder', compact(
            'roadmap',
            'categories'
        ));
    }

    public function update(Request $request, Roadmap $roadmap)
    {
        /** @var User $creator */
        $creator = Auth::user();

        abort_unless(
            $roadmap->creator_id === $creator->id,
            403
        );

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'description' => [
                'required',
                'string',
            ],

            'level' => [
                'required',
                Rule::in([
                    'beginner',
                    'intermediate',
                    'advanced',
                ]),
            ],

            'action' => [
                'required',
                Rule::in([
                    'draft',
                    'submit',
                ]),
            ],

            'resources' => ['nullable', 'array'],

            'resources.*.id' => [
                'nullable',
                'integer',
            ],

            'resources.*.title' => [
                'required',
                'string',
                'max:255',
            ],

            'resources.*.url' => [
                'required',
                'url',
                'max:2048',
            ],

            'resources.*.type' => [
                'required',
                Rule::in([
                    'video',
                    'documentation',
                    'article',
                    'link',
                    'other',
                ]),
            ],

            'resources.*.description' => [
                'required',
                'string',
            ],
        ]);

        $status = $validated['action'] === 'submit'
            ? 'pending_review'
            : 'draft';

        DB::transaction(function () use ($roadmap, $validated, $status) {

            $roadmap->update([
                'category_id' => $validated['category_id'],
                'title' => $validated['title'],
                'description' => $validated['description'],
                'level' => $validated['level'],
                'status' => $status,
            ]);

            $submittedResourceIds = collect(
                $validated['resources'] ?? []
            )
                ->pluck('id')
                ->filter()
                ->values();

            // Delete resources removed from the builder.
            $roadmap->resources()
                ->whereNotIn('id', $submittedResourceIds)
                ->delete();

            foreach ($validated['resources'] ?? [] as $resource) {

                if (! empty($resource['id'])) {

                    $roadmap->resources()
                        ->whereKey($resource['id'])
                        ->update([
                            'title' => $resource['title'],
                            'url' => $resource['url'],
                            'type' => $resource['type'],
                            'description' => $resource['description'],
                        ]);

                    continue;
                }

                $roadmap->resources()->create([
                    'title' => $resource['title'],
                    'url' => $resource['url'],
                    'type' => $resource['type'],
                    'description' => $resource['description'],
                ]);
            }
        });

        return redirect()
            ->route('creator.roadmaps.index')
            ->with(
                'success',
                $status === 'pending_review'
                    ? 'تم إرسال المسار للمراجعة بنجاح.'
                    : 'تم حفظ المسار كمسودة بنجاح.'
            );
    }

    public function destroy(Roadmap $roadmap)
    {
        /** @var User $creator */
        $creator = Auth::user();

        abort_unless(
            $roadmap->creator_id === $creator->id,
            403
        );

        $roadmap->delete();

        return redirect()
            ->route('creator.roadmaps.index')
            ->with('success', 'تم حذف المسار بنجاح.');
    }

    public function submit(Roadmap $roadmap)
    {
        /** @var User $creator */
        $creator = Auth::user();

        abort_unless(
            $roadmap->creator_id === $creator->id,
            403
        );

        abort_if(
            ! in_array($roadmap->status, ['draft', 'rejected']),
            422
        );

        $roadmap->update([
            'status' => 'pending_review',
        ]);

        return redirect()
            ->route('creator.roadmaps.index')
            ->with(
                'success',
                'تم إرسال المسار للمراجعة بنجاح.'
            );
    }
}
