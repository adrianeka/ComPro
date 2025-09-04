<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/test', function () {
//     return view('/landing/layouts/app');
// });

Route::get('/', [LandingController::class, 'index'])->name('home');