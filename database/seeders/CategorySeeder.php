<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_categories')->insert([
            [
                'name' => '腕時計',
                'sort_order' => 1,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => '置時計',
                'sort_order' => 2,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => '懐中時計',
                'sort_order' => 3,
                'created_at' => '2021/01/01 11:11:11',
            ],
        ]);

        DB::table('secondary_categories')->insert([
            [
                'name' => '日本製',
                'sort_order' => 1,
                'primary_category_id' =>  1,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => '外国製',
                'sort_order' => 2,
                'primary_category_id' =>  1,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => '不明',
                'sort_order' => 3,
                'primary_category_id' =>  1,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => '日本製',
                'sort_order' => 4,
                'primary_category_id' =>  2,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => '外国製',
                'sort_order' => 5,
                'primary_category_id' =>  2,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => '不明',
                'sort_order' => 6,
                'primary_category_id' =>  2,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => '日本製',
                'sort_order' => 7,
                'primary_category_id' =>  3,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => '外国製',
                'sort_order' => 8,
                'primary_category_id' =>  3,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => '不明',
                'sort_order' => 9,
                'primary_category_id' =>  3,
                'created_at' => '2021/01/01 11:11:11',
            ],
        ]);
    }
}
