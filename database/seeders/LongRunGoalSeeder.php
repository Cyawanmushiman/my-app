<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LongRunGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('long_run_goals')->insert([
            [
                'user_id' => 1,
                'title' => 'IELTS 5.0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
