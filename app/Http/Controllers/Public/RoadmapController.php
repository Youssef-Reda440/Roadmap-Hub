<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class RoadmapController extends Controller
{
    public function index()
    {
        // For testing Blade templates
        return view('public/explore');
    }

    public function show()
    {
        // For testing Blade templates
        return view('public/roadmap-details');
    }
}
