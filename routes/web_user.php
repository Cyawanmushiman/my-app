<?php

use App\Models\Car;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\SetUpController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\InspireController;
use App\Http\Controllers\User\MindMapController;
use App\Http\Controllers\User\WebPushController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\LongRunGoalController;
use App\Http\Controllers\User\DailyRunGoalController;
use App\Http\Controllers\User\ShortRunGoalController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\MiddleRunGoalController;
use App\Http\Controllers\User\Auth\VerificationController;

// ログイン認証関連
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
// 会員登録
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
// Email Verificationのルート
Route::get('/email/verify', static function () {
    return view('user.auth.verify');
});
// メールアドレス確認
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
// ログアウト
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ログイン認証後
Route::middleware(['auth:user', 'verified'])->group(function () {

    // TOPページ
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::post('home/store', [HomeController::class, 'store'])->name('home.store');
    Route::get('home/good_job', [HomeController::class, 'showGoodJob'])->name('home.show_good_job');

    // 最初の目標設定
    Route::prefix('set_ups')->name('set_ups.')->group(function () {
        Route::get('create_first_goal', [SetUpController::class, 'createFirstGoal'])->name('create_first_goal');
        Route::post('store_first_goal', [SetUpController::class, 'storeFirstGoal'])->name('store_first_goal');
        Route::get('create_mind_map', [SetUpController::class, 'createMindMap'])->name('create_mind_map');
        Route::post('store_mind_map', [SetUpController::class, 'storeMindMap'])->name('store_mind_map');
        Route::get('create_daily_goal', [SetUpController::class, 'createDailyGoal'])->name('create_daily_goal');
        Route::post('store_daily_goal', [SetUpController::class, 'storeDailyGoal'])->name('store_daily_goal');
    });

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

    // daily_scoreの履歴
    Route::get('histories', [HistoryController::class, 'index'])->name('histories.index');
    
    // web_push
    Route::prefix('web_push')->name('web_push.')->group(function () {
        Route::get('create', [WebPushController::class, 'create'])->name('create');
        Route::post('store', [WebPushController::class, 'store'])->name('store');
        Route::get('send', [WebPushController::class, 'send'])->name('send');
    });
});