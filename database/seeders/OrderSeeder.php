<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\BoxPrice;
use App\Models\Order;
use App\Models\OrderBox;
use App\Models\Review;
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
        $faker = \Faker\Factory::create();
        for ($i = 2; $i <= 5; $i++) {
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
            $total = 0;
            for ($j= 1; $j <=3; $j++){
                $qty = rand(1, 10);
                $boxId = rand(1, 4);
                $vendorPrice = BoxPrice::where('vendor_id', $i)->where('box_id', (int)$boxId)->get()->first();
                $orderBox = OrderBox::create([
                    "box_price_id" => $vendorPrice->id,
                    "order_id" => $order->id,
                    "quantity" => $qty,
                    "box_id" => $boxId,
                ]);
                $total+= $qty*$vendorPrice->price;
            }
            $order->total = $total;
            $order->save();
            $review = Review::create([
                "order_id" => $order->id,
                "description" => $faker->text,
                "rate" => rand(1,5),
                "status" => "PENDING",
            ]);
        }
    }
}
