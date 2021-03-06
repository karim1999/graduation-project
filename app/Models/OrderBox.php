<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBox extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function box_price(){
        return $this->belongsTo(BoxPrice::class, 'box_price_id');
    }
    public function box(){
        return $this->belongsTo(Box::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
