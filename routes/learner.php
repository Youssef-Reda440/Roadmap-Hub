<?php

use App\Http\Controllers\Learner\CreatorApplicationController;
use App\Http\Controllers\Learner\DashboardController;
use App\Http\Controllers\Learner\LearningController;
use App\Http\Controllers\Learner\ProfileController;
use App\Http\Controllers\Learner\ReviewController;
use App\Http\Controllers\Learner\SavedRoadmapController;
use Illuminate\Support\Facades\Route;

Route::get('/learner/dashboard', [DashboardController::class, 'index']);

Route::get('/learner/my-learning', [LearningController::class, 'index']);
Route::get('/learner/roadmaps/{roadmap}', [LearningController::class, 'show']);
Route::post('/learner/roadmaps/{roadmap}/enroll', [LearningController::class, 'enroll']);
Route::post('/learner/topics/{topic}/complete ', [LearningController::class, 'completeTopic']);

Route::get('/learner/saved-roadmaps', [SavedRoadmapController::class, 'index']);
Route::post('/learner/roadmaps/{roadmap}/save', [SavedRoadmapController::class, 'store']);
Route::delete('/learner/roadmaps/{roadmap}/save', [SavedRoadmapController::class, 'destroy']);

Route::post('/learner/roadmaps/{roadmap}/reviews', [ReviewController::class, 'store']);
Route::patch('/learner/reviews/{review}', [ReviewController::class, 'update']);
Route::delete('/learner/reviews/{review}', [ReviewController::class, 'destroy']);

Route::get('/learner/profile', [ProfileController::class, 'show']);
Route::patch('/learner/profile', [ProfileController::class, 'update']);

Route::get('/learner/creator-application', [CreatorApplicationController::class, 'show']);
Route::post('/learner/creator-application', [CreatorApplicationController::class, 'store']);
