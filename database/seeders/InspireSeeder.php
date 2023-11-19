<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('inspires')->insert([
            [
                'user_id' => 1,
                'image_url' => '/storage/images/inspires/IoiCuJ6LqE3W3vlU2Ot2irronF9L0WoYyBPwQ4Az.svg',
                'comment' => 'コーヒーが冷めないうちに飲むのが一番だね。今のチャンスも同じ。今、君が頑張っていることは、きっと最高のタイミングなんだ。',
            ],
        ]);
    }
}
