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
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('/my-learning', [LearningController::class, 'index']);
        Route::get('/roadmaps/{roadmap}', [LearningController::class, 'show']);
        Route::post('/roadmaps/{roadmap}/enroll', [LearningController::class, 'enroll']);

        Route::post('/topics/{topic}/complete', [LearningController::class, 'completeTopic']);

        Route::get('/saved-roadmaps', [SavedRoadmapController::class, 'index']);
        Route::post('/roadmaps/{roadmap}/save', [SavedRoadmapController::class, 'store']);
        Route::delete('/roadmaps/{roadmap}/save', [SavedRoadmapController::class, 'destroy']);

        Route::post('/roadmaps/{roadmap}/reviews', [ReviewController::class, 'store']);
        Route::patch('/reviews/{review}', [ReviewController::class, 'update']);
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);

        Route::get('/profile', [ProfileController::class, 'show']);
        Route::patch('/profile', [ProfileController::class, 'update']);

        Route::get('/creator-application', [CreatorApplicationController::class, 'show']);
        Route::post('/creator-application', [CreatorApplicationController::class, 'store']);
    });
