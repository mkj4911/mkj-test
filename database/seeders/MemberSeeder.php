<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            [
                'name' => '山田　太郎',
                'email' => 'test1@test.com',
                'password' => Hash::make('yunikonn'),
                'filename' => '',
                'created_at' => '2022/01/01 11:11:11',
            ],
            [
                'name' => '佐藤　二郎',
                'email' => 'test2@test.com',
                'password' => Hash::make('yunikonn'),
                'filename' => '',
                'created_at' => '2022/01/01 11:11:11',
            ],
            [
                'name' => '時任　三郎',
                'email' => '',
                'password' => Hash::make('yunikonn'),
                'filename' => '',
                'created_at' => '2022/01/01 11:11:11',
            ],
            [
                'name' => '伊東　四郎',
                'email' => 'test4@test.com',
                'password' => Hash::make('yunikonn'),
                'filename' => '',
                'created_at' => '2022/01/01 11:11:11',
            ],
            [
                'name' => '野口　五郎',
                'email' => 'test5@test.com',
                'password' => Hash::make('yunikonn'),
                'filename' => '',
                'created_at' => '2022/01/01 11:11:11',
            ],
            [
                'name' => '道場　六三郎',
                'email' => 'test6@test.com',
                'password' => Hash::make('yunikonn'),
                'filename' => '',
                'created_at' => '2022/01/01 11:11:11',
            ],

        ]);
    }
}
