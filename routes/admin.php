<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CreatorApplicationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoadmapReviewController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin']) -> prefix('admin') ->group (function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/{user}', [UserController::class, 'show']);
            Route::patch('/{user}', [UserController::class, 'update']);
        });

        Route::prefix('creator-applications')->group(function () {
            Route::get('/', [CreatorApplicationController::class, 'index']);
            Route::get('/{application}', [CreatorApplicationController::class, 'show']);
            Route::patch('/{application}/approve', [CreatorApplicationController::class, 'approve']);
            Route::patch('/{application}/reject', [CreatorApplicationController::class, 'reject']);
        });

        Route::prefix('roadmap-reviews')->group(function () {
            Route::get('/', [RoadmapReviewController::class, 'index']);
            Route::get('/{roadmap}', [RoadmapReviewController::class, 'show']);
            Route::patch('/{roadmap}/approve', [RoadmapReviewController::class, 'approve']);
            Route::patch('/{roadmap}/reject', [RoadmapReviewController::class, 'reject']);
            Route::patch('/{roadmap}/request-changes', [RoadmapReviewController::class, 'requestChanges']);
        });

        Route::delete('/roadmaps/{roadmap}', [RoadmapReviewController::class, 'destroy']);

        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::post('/', [CategoryController::class, 'store']);
            Route::get('/{category}', [CategoryController::class, 'show']);
            Route::patch('/{category}', [CategoryController::class, 'update']);
            Route::delete('/{category}', [CategoryController::class, 'destroy']);
        });

        Route::prefix('reports')->group(function () {
            Route::get('/', [ReportController::class, 'index']);
            Route::get('/{report}', [ReportController::class, 'show']);
            Route::patch('/{report}/resolve', [ReportController::class, 'resolve']);
        });

        Route::get('/profile', [ProfileController::class, 'show']);
        Route::patch('/profile', [ProfileController::class, 'update']);
    });
