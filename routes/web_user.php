<?php

use App\Models\Car;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\InspireController;
use App\Http\Controllers\User\MindMapController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\LongRunGoalController;
use App\Http\Controllers\User\DailyRunGoalController;
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
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::post('home', [HomeController::class, 'store'])->name('home.store');
    Route::get('home/good_job', [HomeController::class, 'showGoodJob'])->name('home.show_good_job');

    // 長期目標
    Route::resource('long_run_goals', LongRunGoalController::class)->except(['show']);

    // 中期目標
    Route::resource('middle_run_goals', MiddleRunGoalController::class)->except(['show']);

    // 短期目標
    Route::resource('short_run_goals', ShortRunGoalController::class)->except(['show']);

    // 今日の目標
    Route::resource('daily_run_goals', DailyRunGoalController::class)->except(['show']);

    // インスパイア
    Route::post('inspires/set_default', [InspireController::class, 'setDefault'])->name('inspires.set_default');
    Route::resource('inspires', InspireController::class)->except(['show']);

    // ノード管理
    Route::get('mindMaps', [MindMapController::class, 'index'])->name('mindMaps.index');
});

Route::get('/test-car', function () {
    $myCar = new Car("Toyota", "red");
    dd($myCar);
    $myCar->drive();
});