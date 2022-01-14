<?php

namespace Database\Seeders;

use App\Models\Holiday;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            MemberSeeder::class,
            ShopSeeder::class,
            ImageSeeder::class,
            CategorySeeder::class,
            HolidaySeeder::class,
            UserSeeder::class,
        ]);
        //Product::factory(100)->create();
        Stock::factory(200)->create();
    }
}
