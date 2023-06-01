<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function getDateOfBirthAttribute($date_of_birth)
    {
        if ($date_of_birth != null || $date_of_birth != '') {
            return date("d-m-Y", strtotime($date_of_birth));
        } else {
            return null;
        }
    }

   
}