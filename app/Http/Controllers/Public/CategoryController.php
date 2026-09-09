<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->withCount([
                'roadmaps' => function ($query) {
                    $query->where('status', 'published');
                },
            ])
            ->get();

        return view('public.categories', compact('categories'));
    }
}
