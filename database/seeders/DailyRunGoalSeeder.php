<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyRunGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('daily_run_goals')->insert([
            [
                'user_id' => 1,
                'title' => '8時間寝る',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => '英語4時間勉強する',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
