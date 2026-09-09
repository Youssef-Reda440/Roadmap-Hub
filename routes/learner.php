<?php

use App\Http\Controllers\Learner\CreatorApplicationController;
use App\Http\Controllers\Learner\DashboardController;
use App\Http\Controllers\Learner\LearningController;
use App\Http\Controllers\Learner\ProfileController;
use App\Http\Controllers\Learner\ReviewController;
use App\Http\Controllers\Learner\SavedRoadmapController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:learner'])
    ->prefix('learner')
    ->name('learner.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Learning
        Route::get('/my-learning', [LearningController::class, 'index'])
            ->name('learning.index');
        Route::get('/roadmaps/{roadmap}', [LearningController::class, 'show'])
            ->name('learning.show');
        Route::post('/roadmaps/{roadmap}/enroll', [LearningController::class, 'enroll'])
            ->name('learning.enroll');

        // Saved Roadmaps
        Route::get('/saved-roadmaps', [SavedRoadmapController::class, 'index'])
            ->name('saved-roadmaps.index');
        Route::post('/roadmaps/{roadmap}/save', [SavedRoadmapController::class, 'store'])
            ->name('roadmaps.save');
        Route::delete('/roadmaps/{roadmap}/save', [SavedRoadmapController::class, 'destroy'])
            ->name('roadmaps.unsave');

        // Reviews
        Route::post('/roadmaps/{roadmap}/reviews', [ReviewController::class, 'store'])
            ->name('reviews.store');
        Route::patch('/reviews/{review}', [ReviewController::class, 'update'])
            ->name('reviews.update');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
            ->name('reviews.destroy');

        // Profile
        Route::get('/profile', [ProfileController::class, 'show'])
            ->name('profile.show');
        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        // Creator Application
        Route::get('/creator-application', [CreatorApplicationController::class, 'show'])
            ->name('creator-application.show');
        Route::post('/creator-application', [CreatorApplicationController::class, 'store'])
            ->name('creator-application.store');
    });
