<?php

require __DIR__ . '/public.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/learner.php';
require __DIR__ . '/creator.php';
require __DIR__ . '/admin.php';

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('roadmap-hub');
});
