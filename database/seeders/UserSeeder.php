<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(
            [
                1 => [
                    'name' => 'テストユーザー', 
                    'email' => 'user1@test.com', 
                    'password' => \Hash::make('11111111'), 
                    'remember_token' => \Str::random(10), 
                    'email_verified_at' => now(), 
                    'has_first_goal' => true,
                    'is_mind_map_create' => true,
                    'has_daily_goal' => true,
                    'created_at' => now(), 
                    'updated_at' => now()
                ],
            ]
        );
    }
}