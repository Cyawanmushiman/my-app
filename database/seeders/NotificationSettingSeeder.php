<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('notification_settings')->insert([
            [
                'user_id' => 1,
                'content' => '月曜日の通知内容はこれです。通知内容はこれです。通知内容はこれです。通知内容はこれです。通知内容はこれです。通知内容はこれです。',
                'day_of_week' => 'Monday',
                'action_time' => '09:00:00',
                'is_enable' => true,
            ],
            [
                'user_id' => 1,
                'content' => '水曜日の通知内容はこれです。通知内容はこれです。通知内容はこれです。通知内容はこれです。通知内容はこれです。通知内容はこれです。',
                'day_of_week' => 'Wednesday',
                'action_time' => '12:00:00',
                'is_enable' => false,
            ],
        ]);
    }
}
