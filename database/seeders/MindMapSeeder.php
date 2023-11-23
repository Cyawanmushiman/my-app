<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MindMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('mind_maps')->insert([
            [
                'user_id' => 1,
                'mind_data_json' => '{"meta":{},"format":"node_tree","data":{"id":"root","topic":"IELTS 5.0","expanded":true,"children":[{"id":"middleRunGoalId1","topic":"TOEIC700点","expanded":true,"direction":"right"},{"id":"bf1f3aa22bffdacb","topic":"新しいノード bf1f3","expanded":true,"direction":"right"},{"id":"bf1f3c1a5b78f5fd","topic":"New Node","expanded":true,"direction":"left"},{"id":"bf1f3b41ce3c3820","topic":"New Node","expanded":true,"direction":"left"}]}}',
            ],
        ]);
    }
}
