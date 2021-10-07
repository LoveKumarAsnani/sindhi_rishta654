<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const EMAIL_VERIFIED = true;
    const EMAIL_NOT_VERIFIED = false;

    const PHONE_NUMBER_VERFIED = true;
    const PHONE_NUMBER_NOT_VERIFIED = false;

    const USER_VERFIED = 'Verified';
    const USER_UN_VERFIED = 'Unverfied';
    const USER_BLOCK = 'Block';



    public function friends(){
        return $this->hasMany(Friends::class);
    }
    
    public function profile(){
        return $this->hasOne(Profiles::class);
    }
    

    public function pictures(){
        return $this->hasMany(Pictures::class);
    }

    public function favorites(){
        return $this->hasMany(UserFavorites::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'nick_name',
        'user_name',
        'email',
        'password',
        'phone_number',
        'is_email_verified',
        'is_phone_number_verified',
        'verification_token',
        'device_notify_token',
        'status'
    ];
    

    public static function generateVerificationCode(){
        return Str::random(40);
    }

    public static function deviceNotificationToken(){
        return Str::random(10);
    }
	
        

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
