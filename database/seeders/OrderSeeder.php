<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\BoxPrice;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'email' => "customer".$i."@gmail.com",
                'name' => "customer".$i,
                'password' => \Hash::make("customer".$i),
            ]);
            for ($j = 1; $j <= 3; $j++) {
                $faker = \Faker\Factory::create();
                $user->addresses()->create([
                    "country" => $faker->country,
                    "state" => $faker->city,
                    "city" => $faker->city,
                    "address" => $faker->streetAddress,
                    "lat" => $faker->latitude,
                    "lng" => $faker->longitude,
                ]);
            }
        }
    }
}
