<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxPrice extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function box(){
        return $this->belongsTo(Box::class);
    }
    public function vendor(){
        return $this->belongsTo(config('admin.database.users_model'), 'vendor_id');
    }
}
