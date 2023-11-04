<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\LongRunGoalController;
use App\Http\Controllers\User\Auth\RegisterController;

// ログイン認証関連
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ログイン認証後
Route::middleware('auth:user')->group(function () {

    // TOPページ
    Route::get('/home', [HomeController::class, 'home'])->name('home');

    Route::resource('long_run_goals', LongRunGoalController::class)->except(['show']);
});