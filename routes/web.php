<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
});
Route::resource('threads', ThreadController::class);
Route::resource('posts', PostController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
});