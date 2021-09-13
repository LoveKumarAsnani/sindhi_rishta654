<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'friend_user_id',
        'request_date'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
