<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $enrolledRoadmaps = $user->roadmapEnrollments()
            ->with(['roadmap.category', 'roadmap.creator'])
            ->latest('enrolled_at')
            ->get();

        $savedRoadmaps = $user->savedRoadmaps()
            ->with(['roadmap.category', 'roadmap.creator'])
            ->latest('saved_at')
            ->get();

        $reviews = $user->reviews()
            ->with('roadmap')
            ->latest()
            ->get();

        return view('learner.dashboard', compact(
            'enrolledRoadmaps',
            'savedRoadmaps',
            'reviews'
        ));
    }
}
