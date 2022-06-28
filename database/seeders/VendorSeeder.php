<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\BoxPrice;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $vendor = \Encore\Admin\Auth\Database\Administrator::create([
                'username' => "vendor".$i,
                'name' => "vendor".$i,
                'password' => \Hash::make("vendor".$i),
            ]);
            $vendor->roles()->sync([2]);
            for ($j = 1; $j < 5; $j++) {
                $box= Box::find($j);
                $boxPrice = BoxPrice::create([
                    'vendor_id' => $vendor->id,
                    'box_id' => $j,
                    'price' => $box->width*(rand(10,100)/100),
                ]);
            }
        }
    }
}
