<?php

require __DIR__ . '/public.php';
require __DIR__ . '/learner.php';
require __DIR__ . '/creator.php';
require __DIR__ . '/admin.php';

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/test', function () {
//     return view('roadmap-hub');
// });

Route::get('/test', function() {
    return view('layouts.guest');
});

Route::get('/hello', function() {
    return view('roadmap-hub');
});

// Route::get('/users', [UserController::class, 'index'])->name('user.index');
// Route::get('/user/create', [UserController::class, 'create']);
// Route::post('/user/store', [UserController::class, 'store'])->name('user.create');
