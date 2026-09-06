<?php

use App\Http\Controllers\Creator\DashboardController;
use App\Http\Controllers\Creator\RoadmapController;
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
        });
    });
