<?php

use App\Http\Controllers\Creator\DashboardController;
use App\Http\Controllers\Creator\ProfileController;
use App\Http\Controllers\Creator\ReviewController;
use App\Http\Controllers\Creator\RoadmapController;
use App\Http\Controllers\Creator\StatisticsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:creator'])
    ->prefix('creator')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::prefix('roadmaps')->group(function () {
            Route::get('/', [RoadmapController::class, 'index']);
            Route::get('/create', [RoadmapController::class, 'create']);
            Route::post('/', [RoadmapController::class, 'store']);
            Route::get('/{roadmap}/edit', [RoadmapController::class, 'edit']);
            Route::patch('/{roadmap}', [RoadmapController::class, 'update']);
            Route::delete('/{roadmap}', [RoadmapController::class, 'destroy']);
            Route::post('/{roadmap}/submit', [RoadmapController::class, 'submit']);

            Route::get('/{roadmap}/statistics', [StatisticsController::class, 'show']);
        });

        Route::get('/reviews', [ReviewController::class, 'index']);

        Route::get('/profile', [ProfileController::class, 'show']);
        Route::patch('/profile', [ProfileController::class, 'update']);
    });
