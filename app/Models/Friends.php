<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    use HasFactory;

    const NEWW = 1;
    const ACCEPTED = 2;
    const DENIED = 3;

   

    protected $fillable = [
        'user_id',
        'friend_user_id',
        'request_date'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
