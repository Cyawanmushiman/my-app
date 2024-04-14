<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('notification_methods')->insert([
            [
                'notification_setting_id' => 1,
                'method' => 1,
            ],
            [
                'notification_setting_id' => 1,
                'method' => 2,
            ],
            [
                'notification_setting_id' => 2,
                'method' => 1,
            ],
        ]);
    }
}
