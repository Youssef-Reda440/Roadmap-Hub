<?php

use App\Http\Controllers\Creator\DashboardController;
use App\Http\Controllers\Creator\RoadmapController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:creator'])
    ->prefix('creator')
    ->name('creator.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Roadmaps
        Route::prefix('roadmaps')
            ->name('roadmaps.')
            ->group(function () {
                Route::get('/', [RoadmapController::class, 'index'])
                    ->name('index');
                Route::get('/create', [RoadmapController::class, 'create'])
                    ->name('create');
                Route::post('/', [RoadmapController::class, 'store'])
                    ->name('store');
                Route::get('/{roadmap}/edit', [RoadmapController::class, 'edit'])
                    ->name('edit');
                Route::patch('/{roadmap}', [RoadmapController::class, 'update'])
                    ->name('update');
                Route::delete('/{roadmap}', [RoadmapController::class, 'destroy'])
                    ->name('destroy');
                Route::post('/{roadmap}/submit', [RoadmapController::class, 'submit'])
                    ->name('submit');
            });
    });
