<?php

use App\Http\Controllers\Creator\DashboardController;
use App\Http\Controllers\Creator\ProfileController;
use App\Http\Controllers\Creator\ReviewController;
use App\Http\Controllers\Creator\RoadmapController;
use App\Http\Controllers\Creator\StatisticsController;
use Illuminate\Support\Facades\Route;

Route::get('/creator/dashboard', [DashboardController::class, 'index']);

Route::get('/creator/roadmaps', [RoadmapController::class, 'index']);
Route::get('/creator/roadmaps/create', [RoadmapController::class, 'create']);
Route::post('/creator/roadmaps', [RoadmapController::class, 'store']);
Route::get('/creator/roadmaps/{roadmap}/edit', [RoadmapController::class, 'edit']);
Route::patch('/creator/roadmaps/{roadmap}', [RoadmapController::class, 'update']);
Route::delete('/creator/roadmaps/{roadmap}', [RoadmapController::class, 'destroy']);
Route::post('/creator/roadmaps/{roadmap}/submit', [RoadmapController::class, 'submit']);

Route::get('/creator/roadmaps/{roadmap}/statistics', [StatisticsController::class, 'show']);

Route::get('/creator/reviews', [ReviewController::class, 'index']);

Route::get('/creator/profile', [ProfileController::class, 'show']);
Route::patch('/creator/profile', [ProfileController::class, 'update']);
