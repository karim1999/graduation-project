<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function getFormattedAttribute(){
        return $this->address.", ".$this->city.", ".$this->state.", ".$this->country." (".$this->lat.", ".$this->lng.")";
    }
}
