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
                'image_url' => '/storage/images/inspires/IoiCuJ6LqE3W3vlU2Ot2irronF9L0WoYyBPwQ4Az.svg',
                'comment' => '今日も頑張ったね！',
            ],
        ]);
    }
}
