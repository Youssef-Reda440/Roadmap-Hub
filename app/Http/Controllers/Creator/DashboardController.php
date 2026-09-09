<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $creator */
        $creator = Auth::user();

        $roadmaps = $creator->roadmaps();

        $stats = [
            'total_roadmaps' => $roadmaps->count(),

            'total_reviews' => Review::whereHas('roadmap', function ($query) use ($creator) {
                $query->where('creator_id', $creator->id);
            })->count(),

            'average_rating' => round(
                Review::whereHas('roadmap', function ($query) use ($creator) {
                    $query->where('creator_id', $creator->id);
                })->avg('rating') ?? 0,
                1
            ),

            'total_learners' => $creator->roadmaps()
                ->whereHas('enrollments')
                ->with('enrollments')
                ->get()
                ->flatMap(function ($roadmap) {
                    return $roadmap->enrollments;
                })
                ->pluck('user_id')
                ->unique()
                ->count(),
        ];

        $recentRoadmaps = $creator->roadmaps()
            ->with('category')
            ->withCount('resources', 'enrollments')
            ->withAvg('reviews', 'rating')
            ->latest()
            ->take(5)
            ->get();

        $recentReviews = Review::query()
            ->whereHas('roadmap', function ($query) use ($creator) {
                $query->where('creator_id', $creator->id);
            })
            ->with([
                'user',
                'roadmap',
            ])
            ->latest()
            ->take(5)
            ->get();

        return view('creator.dashboard', compact(
            'creator',
            'stats',
            'recentRoadmaps',
            'recentReviews'
        ));
    }
}
