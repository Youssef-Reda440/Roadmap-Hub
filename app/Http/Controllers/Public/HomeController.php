<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // return view('components/footer');
        // return view('components/navbar');
        // return view('components/roadmap-card');
        return view('public/explore');
    }
}
