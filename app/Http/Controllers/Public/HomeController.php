<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Roadmap;

class HomeController extends Controller
{
    public function index()
    {
        $featuredRoadmaps = Roadmap::query()
            ->where('status', 'published')
            ->with(['category', 'creator'])
            ->latest()
            ->take(6)
            ->get();

        return view('public.home', compact('featuredRoadmaps'));
    }
}
