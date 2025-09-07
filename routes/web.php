<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/test', function () {
//     return view('/landing/layouts/app');
// });

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/team/{slug}', [LandingController::class, 'teamDetail'])->name('team.detail');
// Route::get('/news', [NewsController::class, 'all'])->name('news.all');
Route::get('/news/{slug}', [LandingController::class, 'detail'])->name('news.detail');
Route::get('/news', [LandingController::class, 'news'])->name('news');

// ADMIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['loginrequired'])->get('/admin', function() {
    return redirect()->route('admin.news.index');
});
Route::middleware(['loginrequired'])->prefix('admin/news')->name('admin.news.')->group(function() {
    Route::resource('/', NewsController::class)->parameters(['' => 'id']);
});
Route::post('/admin/ckeditor/upload', [\App\Http\Controllers\NewsController::class, 'uploadEditorImage'])->name('admin.ckeditor.upload');

