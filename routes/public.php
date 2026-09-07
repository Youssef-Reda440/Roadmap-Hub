<?php

use App\Http\Controllers\Public\CategoryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\RoadmapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('home.index');

Route::get('/roadmaps', [RoadmapController::class, 'index'])
    ->name('roadmaps.index');
Route::get('/roadmaps/{roadmap}', [RoadmapController::class, 'show'])
    ->name('roadmaps.show');

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');
