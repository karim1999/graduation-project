<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\BoxPrice;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
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
            $user = User::find($i);
            $addresses = $user->addresses;
            $order = Order::create([
                "user_id" => $user->id,
                "from_address_id" => $addresses[0]->id,
                "to_address_id" => $addresses[1]->id,
                "vendor_id" => $i,
                "total" => rand(1000,2000),
                "distance" => rand(1000,2000),
                "status" => "PENDING",
                "ship_date" => Carbon::now(),
            ]);
        }
    }
}
