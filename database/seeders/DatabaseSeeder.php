<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            AdminTablesSeeder::class,
            BoxSeeder::class,
            VendorSeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
//            ReviewSeeder::class,
        ]);
    }
}
