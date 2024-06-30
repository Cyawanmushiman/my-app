<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\SetUpController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\InspireController;
use App\Http\Controllers\User\MindMapController;
use App\Http\Controllers\User\PurposeController;
use App\Http\Controllers\User\LineLoginController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\LongRunGoalController;
use App\Http\Controllers\User\DailyRunGoalController;
use App\Http\Controllers\User\ShortRunGoalController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\MiddleRunGoalController;
use App\Http\Controllers\User\Auth\VerificationController;
use App\Http\Controllers\User\NotificationSettingController;

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

Route::get('linelogin', [LineLoginController::class, 'lineLogin'])->name('linelogin');
Route::get('callback', [LineLoginController::class, 'callback'])->name('callback');

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
    
    // 目的管理
    Route::resource('purposes', PurposeController::class)->except(['show']);

    // 長期目標
    Route::get('long_run_goals/{purpose}/create', [LongRunGoalController::class, 'create'])->name('long_run_goals.create');
    Route::resource('long_run_goals', LongRunGoalController::class)->except(['show', 'create']);

    // 中期目標
    Route::prefix('middle_run_goals')->name('middle_run_goals.')->group(function () {
        Route::get('index/{long_run_goal}', [MiddleRunGoalController::class, 'index'])->name('index');
        Route::get('{long_run_goal}/create', [MiddleRunGoalController::class, 'create'])->name('create');
        Route::post('middle_run_goals', [MiddleRunGoalController::class, 'store'])->name('store');
        Route::get('{middle_run_goal}/edit', [MiddleRunGoalController::class, 'edit'])->name('edit');
        Route::patch('update/{middle_run_goal}', [MiddleRunGoalController::class, 'update'])->name('update');
        Route::delete('{middle_run_goal}', [MiddleRunGoalController::class, 'destroy'])->name('destroy');
    });
        
    // // 短期目標
    // Route::resource('short_run_goals', ShortRunGoalController::class)->except(['show']);

    // 今日の目標
    Route::resource('daily_run_goals', DailyRunGoalController::class)->except(['show']);

    // インスパイア
    Route::post('inspires/set_default', [InspireController::class, 'setDefault'])->name('inspires.set_default');
    Route::resource('inspires', InspireController::class)->except(['show']);

    // ノード管理
    Route::get('mind_maps/edit_sort', [MindMapController::class, 'editSort'])->name('mind_maps.edit_sort');
    Route::post('mind_maps/update_sort', [MindMapController::class, 'updateSort'])->name('mind_maps.update_sort');
    Route::resource('mind_maps', MindMapController::class)->except(['show', 'update']);

    // daily_scoreの履歴
    Route::prefix('histories')->name('histories.')->group(function () {
        Route::get('/', [HistoryController::class, 'index'])->name('index');
        Route::get('past_scores', [HistoryController::class, 'pastScores'])->name('past_scores');
    });

    // 通知設定
    Route::prefix('notification_settings')->name('notification_settings.')->group(function () {
        Route::get('edit', [NotificationSettingController::class, 'edit'])->name('edit');
        Route::patch('update', [NotificationSettingController::class, 'update'])->name('update');
        Route::get('line_notification_guide', [NotificationSettingController::class, 'lineNotificationGuide'])->name('line_notification_guide');
        Route::get('line_alignment', [NotificationSettingController::class, 'lineAlignment'])->name('line_alignment');
    });
});
