<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'user1',
                'email' => 'user1@test.com',
                'password' => Hash::make('yunikonn'),
                'created_at' => '2022/01/01 11:11:11',
            ],
            [
                'name' => 'user2',
                'email' => 'user2@test.com',
                'password' => Hash::make('yunikonn'),
                'created_at' => '2022/01/01 11:11:11',
            ],
            [
                'name' => 'user3',
                'email' => 'user3@test.com',
                'password' => Hash::make('yunikonn'),
                'created_at' => '2022/01/01 11:11:11',
            ],
        ]);
    }
}
