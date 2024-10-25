<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenaltySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('penalties')->insert([
            [
                'content' => '設定を再調整して再挑戦',
            ],
            [
                'content' => 'ボスのHPと自分のHPをリセットして再挑戦',
            ],
            [
                'content' => '引き続きこのまま再挑戦',
            ],
        ]);
    }
}
