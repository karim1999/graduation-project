<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function boxes(){
        return $this->hasMany(OrderBox::class);
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function vendor(){
        return $this->belongsTo(config('admin.database.users_model'), 'vendor_id');
    }
    public function from_address(){
        return $this->belongsTo(Address::class, 'from_address_id');
    }
    public function to_address(){
        return $this->belongsTo(Address::class, 'to_address_id');
    }
}
