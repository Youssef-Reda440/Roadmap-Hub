<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Roadmap;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function index(Request $request)
    {
        $query = Roadmap::query()
            ->where('status', 'published')
            ->with(['category', 'creator']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        $roadmaps = $query
            ->latest()
            ->get();

        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('public.explore', compact('roadmaps', 'categories'));
    }

    public function show(Roadmap $roadmap)
    {
        $roadmap->load([
            'category',
            'creator',
            'resources',
            'reviews.user',
        ]);

        abort_if($roadmap->status !== 'published', 404);

        return view('public.roadmap-details', compact('roadmap'));
    }
}
