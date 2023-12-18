<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admins')->insert(
            [
                1 => ['name' => 'テスト管理者', 'email' => 'admin1@test.com', 'password' => \Hash::make('11111111'), 'remember_token' => \Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ]
        );
    }
}