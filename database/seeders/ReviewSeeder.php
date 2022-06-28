<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 1; $i <= 5; $i++) {
            $review = Review::create([
                "order_id" => $i,
                "description" => $faker->text,
                "rate" => rand(1,5),
                "status" => "PENDING",
            ]);
        }
    }
}
