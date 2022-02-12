<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pictures extends Model
{
    use HasFactory;


    // public function getImageNameAttribute()
    // {
    // if ($this->image_active == '1') {
    //     return $this->image_name;
    // } else {
    //     return 'block_image.png';
    // }
    // }

    protected $fillable = [
        'user_id',
        'image_name'
    ];
}
