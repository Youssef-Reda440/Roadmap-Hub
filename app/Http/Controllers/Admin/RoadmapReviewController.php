<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Roadmap;
use Illuminate\Http\Request;

class RoadmapReviewController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['status' => ['nullable', 'in:draft,pending_review,published,rejected']]);

        $roadmaps = Roadmap::with(['creator', 'category'])
            ->withCount(['reviews', 'enrollments', 'savedByUsers'])
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->input('status')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $resourceCounts = Resource::query()
            ->selectRaw('roadmap_id, count(*) as aggregate')
            ->whereIn('roadmap_id', $roadmaps->pluck('id'))
            ->groupBy('roadmap_id')
            ->pluck('aggregate', 'roadmap_id');

        $roadmaps->each(fn (Roadmap $roadmap) => $roadmap->setAttribute('resources_count', $resourceCounts[$roadmap->id] ?? 0));

        return view('admin.roadmap-reviews', compact('roadmaps'));
    }

    public function show(Roadmap $roadmap)
    {
        return view('admin.roadmap-reviews', [
            'roadmaps' => Roadmap::with(['creator', 'category'])->latest()->paginate(15),
            'roadmap' => $roadmap->load(['creator', 'category', 'reviews.user', 'enrollments.user']),
            'resources' => Resource::where('roadmap_id', $roadmap->id)->get(),
        ]);
    }

    public function approve(Roadmap $roadmap)
    {
        if ($roadmap->status !== 'pending_review') {
            return back()->with('error', 'Only roadmaps pending review can be published.');
        }

        $roadmap->status = 'published';
        $roadmap->save();

        return back()->with('success', 'Roadmap published successfully.');
    }

    public function reject(Roadmap $roadmap)
    {
        if ($roadmap->status !== 'pending_review') {
            return back()->with('error', 'Only roadmaps pending review can be rejected.');
        }

        $roadmap->status = 'rejected';
        $roadmap->save();

        return back()->with('success', 'Roadmap rejected successfully.');
    }

    public function requestChanges(Roadmap $roadmap)
    {
        return back()->with('error', 'Request changes is unavailable because the current database schema does not support review notes or a changes-requested status.');
    }

    public function destroy(Roadmap $roadmap)
    {
        if ($roadmap->status !== 'published') {
            return back()->with('error', 'Only published roadmaps can be removed by an admin.');
        }

        $roadmap->delete();

        return back()->with('success', 'Roadmap removed successfully.');
    }
}
