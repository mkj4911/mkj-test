<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'mkj',
            'email' => 'mkj@test.com',
            'password' => Hash::make('yunikonn'),
            'created_at' => '2022/01/01 11:11:11',
        ]);
    }
}
