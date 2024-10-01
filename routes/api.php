<?php

use App\Models\DailyRunGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MindMapController;
use App\Http\Controllers\Api\DailyRunGoalController;
use App\Http\Controllers\Api\LineRegistrationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('mindMaps')->name('mindMaps.')->group(function () {
    Route::post('update', [MindMapController::class, 'update']);
    // 一時フォルダに画像をアップロードする
    Route::post('temp_upload_image', [MindMapController::class, 'tempUploadImage']);
    Route::post('upload_images', [MindMapController::class, 'uploadImages']);
    Route::post('delete_images', [MindMapController::class, 'deleteImages']);
});

// 毎日の目標のステータスを更新する
Route::post('daily_run_goals/update', [DailyRunGoalController::class, 'update']);
