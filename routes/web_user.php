<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\LongRunGoalController;
use App\Http\Controllers\User\ShortRunGoalController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\MiddleRunGoalController;

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

    // 長期目標
    Route::resource('long_run_goals', LongRunGoalController::class)->except(['show']);

    // 中期目標
    Route::resource('middle_run_goals', MiddleRunGoalController::class)->except(['show']);

    // 短期目標
    Route::resource('short_run_goals', ShortRunGoalController::class)->except(['show']);
});