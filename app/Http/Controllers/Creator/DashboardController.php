<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // For testing Blade templates
        $name = 'Youssef';
        return view('creator.dashboard', compact('name'));
    }
}
