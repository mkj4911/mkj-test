<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('holidays')->insert([
            [
                'admin_id' => 1,
                'flag_mon' => 1,
                'flag_tue' => 1,
                'flag_wed' => 1,
                'flag_thu' => 1,
                'flag_fri' => 1,
                'flag_sat' => 2,
                'flag_sun' => 2,
                'flag_holiday' => 2
            ],
        ]);
    }
}
