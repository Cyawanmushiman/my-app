<?php

namespace App\Http\Controllers\User;

use GuzzleHttp\Client;
use App\Enums\DayOfWeek;
use Illuminate\View\View;
use App\Models\NotificationMethod;
use App\Models\NotificationSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\User\NotificationSettingController\UpdateRequest;

class NotificationSettingController extends Controller
{
    /**
     * 編集フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $notificationSettings = NotificationSetting::where('user_id', auth()->id())->get();
        return view('user.notification_settings.edit', [
            'notificationSettings' => $notificationSettings,
        ]);
    }

    /**
     * 更新
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        // トランザクション
        \DB::transaction(function () use ($request) {
            // 一旦全削除
            NotificationSetting::where('user_id', auth()->id())->delete();
            // Mondayプレフィックス、Tuesdayプレフィックス、Wednesdayプレフィックス、Thursdayプレフィックス、Fridayプレフィックス、Saturdayプレフィックス、Sundayプレフィックスにグループ化
            
            // 新しいグループ化された配列を初期化
            $groupedSettings = [];
            foreach ($request->substitutable() as $key => $value) {
                // 曜日をキー名から取得
                preg_match('/(Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|Sunday)/', $key, $matches);
                $day = $matches[0] ?? null;
    
                // 曜日が見つかった場合は、それに応じて配列に追加
                if ($day) {
                    $groupedSettings[$day][str_replace($day . '-', '', $key)] = $value;
                }
            }
            // 配列の中身がnullの場合は、削除
            foreach ($groupedSettings as $day => $settings) {
                if ($settings['content'] === null && $settings['action_time'] === null) {
                    unset($groupedSettings[$day]);
                }
            }
            
            // 保存
            foreach ($groupedSettings as $day => $settings) {
                if (empty($settings['is_enable'])) {
                    $isEnable = false;
                } else {
                    $isEnable = true;
                }
                
                $notificationSetting = NotificationSetting::create([
                    'user_id' => auth()->id(),
                    'content' => $settings['content'],
                    'day_of_week' => $day,
                    'action_time' => $settings['action_time'],
                    'is_enable' => $isEnable,
                ]);
                
                foreach ($settings['methods'] as $method) {
                    NotificationMethod::create([
                        'notification_setting_id' => $notificationSetting->id,
                        'method' => $method,
                    ]);
                }
            }
        });
        
        return back()->with('status', '更新しました');
    }
    
    // line通知の設定方法案内ページの表示
    public function lineNotificationGuide(): View
    {
        return view('user.notification_settings.line_notification_guide');
    }
    
    // lineと連携
    public function lineAlignment(): RedirectResponse
    {        
        // リダイレクト
        return to_route('user.linelogin');
    }
}