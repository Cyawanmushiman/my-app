<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// トップにアクセスしたらリダイレクト
Route::get('/', function () {
    return redirect()->route('user.home');
});

// 開発中ログイン(ユーザー)
Route::get('user_dev_login', function () {
    abort_unless(app()->environment('local'), 403);
    auth()->login(App\Models\User::first());
    return to_route('user.home');
})->name('user_dev_login');

Route::get('user_dev_login_id/{id}', function ($id) {
    abort_unless(app()->environment('local'), 403);
    auth()->login(App\Models\User::find($id));
    return to_route('user.home');
})->name('user_dev_login_id');

// 開発中ログイン(管理者)
Route::get('admin_dev_login', function () {
    abort_unless(app()->environment('local'), 403);
    auth()->guard('admin')->login(App\Models\Admin::first());
    return to_route('admin.home');
})->name('admin_dev_login');

Route::get('admin_dev_login_id/{id}', function ($id) {
    abort_unless(app()->environment('local'), 403);
    auth()->guard('admin')->login(App\Models\Admin::find($id));
    return to_route('admin.home');
})->name('admin_dev_login_id');

// エラー画面テスト
Route::get('500', function () {
    \Log::error('500エラーのテスト');
    abort(500);
});

// サンプル画面
// Route::prefix('samples')->group(function () {

// });