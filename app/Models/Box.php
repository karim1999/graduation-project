<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    protected $guarded= [];
    protected $appends = [
        'size',
        'image_url'
    ];

    public function getSizeAttribute(){
        return $this->width."*".$this->height.'*'.$this->length;
    }
    public function getImageUrlAttribute(){
        return \Storage::url($this->img);
    }
}
