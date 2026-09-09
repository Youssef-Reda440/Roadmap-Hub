<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreatorApplication;
use App\Models\Report;
use App\Models\Review;
use App\Models\Roadmap;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalCreators' => User::where('role', 'creator')->count(),
            'totalRoadmaps' => Roadmap::count(),
            'pendingRoadmaps' => Roadmap::where('status', 'pending_review')->count(),
            'pendingCreatorApplications' => CreatorApplication::where('status', 'pending')->count(),
            'pendingReports' => Report::where('status', 'pending')->count(),
            'averageRating' => Review::avg('rating') ?? 0,
        ]);
    }
}
