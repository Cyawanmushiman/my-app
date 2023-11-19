<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('daily_scores')->insert([
            [
                'user_id' => 1,
                'diary' => '今日は良い天気でした。',
                'score' => 100,
                'created_at' => '2023-11-11 00:00:00',
            ],
            [
                'user_id' => 1,
                'diary' => '今日は良い天気でした。',
                'score' => 100,
                'created_at' => '2023-11-10 00:00:00',
            ],
            [
                'user_id' => 1,
                'diary' => '今日は良い天気でした。',
                'score' => 100,
                'created_at' => '2023-11-08 00:00:00',
            ],
        ]);
    }
}
