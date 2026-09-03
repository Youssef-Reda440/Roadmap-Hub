<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CreatorApplicationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoadmapReviewController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', [DashboardController::class, 'index']);

Route::get('/admin/users', [UserController::class, 'index']);
Route::get('/admin/users/{user}', [UserController::class, 'show']);
Route::patch('/admin/users/{user}', [UserController::class, 'update']);

Route::get('/admin/creator-applications', [CreatorApplicationController::class, 'index']);
Route::get('/admin/creator-applications/{application}', [CreatorApplicationController::class, 'show']);
Route::patch('/admin/creator-applications/{application}/approve', [CreatorApplicationController::class, 'approve']);
Route::patch('/admin/creator-applications/{application}/reject', [CreatorApplicationController::class, 'reject']);

Route::get('/admin/roadmap-reviews', [RoadmapReviewController::class, 'index']);
Route::get('/admin/roadmap-reviews/{roadmap}', [RoadmapReviewController::class, 'show']);
Route::patch('/admin/roadmap-reviews/{roadmap}/approve', [RoadmapReviewController::class, 'approve']);
Route::patch('/admin/roadmap-reviews/{roadmap}/reject', [RoadmapReviewController::class, 'reject']);
Route::patch('/admin/roadmap-reviews/{roadmap}/request-changes', [RoadmapReviewController::class, 'requestChanges']);
Route::delete('/admin/roadmaps/{roadmap}', [RoadmapReviewController::class, 'destroy']);

Route::get('/admin/categories', [CategoryController::class, 'index']);
Route::post('/admin/categories', [CategoryController::class, 'store']);
Route::get('/admin/categories/{category}', [CategoryController::class, 'show']);
Route::patch('/admin/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy']);

Route::get('/admin/reports', [ReportController::class, 'index']);
Route::get('/admin/reports/{report}', [ReportController::class, 'show']);
Route::patch('/admin/reports/{report}/resolve', [ReportController::class, 'resolve']);

Route::get('/admin/profile', [ProfileController::class, 'show']);
Route::patch('/admin/profile', [ProfileController::class, 'update']);
