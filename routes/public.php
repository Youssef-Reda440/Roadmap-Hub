<?php

use App\Http\Controllers\Public\CategoryController;
use App\Http\Controllers\Public\CreatorProfileController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\RoadmapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/roadmaps', [RoadmapController::class, 'index']);
Route::get('/roadmaps/{roadmap}', [RoadmapController::class, 'show']);

Route::get('/creators/{creator}', [CreatorProfileController::class, 'show']);

Route::get('/roadmaps/{roadmap}', [CategoryController::class, 'index']);
