<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // For testing Blade templates
        return view('public/home');
    }
}
