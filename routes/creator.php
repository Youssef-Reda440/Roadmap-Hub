<?php

use App\Http\Controllers\Creator\DashboardController;
use App\Http\Controllers\Creator\RoadmapController;
use Illuminate\Support\Facades\Route;

Route::prefix('creator')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('creator.dashboard');

        Route::prefix('roadmaps')->group(function () {
            Route::get('/', [RoadmapController::class, 'index'])->name('creator.roadmaps');
            Route::get('/create', [RoadmapController::class, 'create'])->name('creator.roadmaps.create');
            Route::post('/', [RoadmapController::class, 'store']);
            Route::get('/{roadmap}/edit', [RoadmapController::class, 'edit']);
            Route::patch('/{roadmap}', [RoadmapController::class, 'update']);
            Route::delete('/{roadmap}', [RoadmapController::class, 'destroy']);
            Route::post('/{roadmap}/submit', [RoadmapController::class, 'submit']);
        });
    });
