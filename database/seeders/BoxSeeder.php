<?php

namespace Database\Seeders;

use App\Models\Box;
use Illuminate\Database\Seeder;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 10; $i <= 100; $i=$i*2){
            Box::create([
                "name" => "Box".$i,
                "img" => "images/635fdda647c003e6d489c064390c5e80.svg",
                "width" => $i,
                "height" => $i,
                "length" => $i,
                "weight" => $i,
            ]);
        }
    }
}
