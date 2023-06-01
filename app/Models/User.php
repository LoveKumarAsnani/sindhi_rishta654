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

    const EMAIL_VERIFIED = '1';
    const EMAIL_NOT_VERIFIED = '0';

    const PHONE_NUMBER_VERFIED = '1';
    const PHONE_NUMBER_NOT_VERIFIED = '0';

    const USER_VERFIED = '1';
    const USER_UN_VERFIED = '0';
    const USER_BLOCK = '2';

    const MALE_PROFILE_PICTURE = 'dummy_picture_male.png';
    const FEMALE_PROFILE_PICTURE = 'dummy_picture_female.png';

    const MALE = '1';
    const FEMALE = '2';
    const OTHER = '3';



    public function opposite_gender()
    {


        // $userr = User::findOrFail(auth()->user()->id);
        // if ($userr->gender == User::MALE) {
        //     $gender =  User::FEMALE;
        // } else  if ($userr->gender == User::FEMALE) {
        //     $gender = USER::MALE;
        // }
    }

    // public function friends()
    // {
    //     return $this->hasMany(Friends::class);
    // }

    function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_user_id');
    }

    function related_friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_user_id', 'user_id');
    }

    public function profile()
    {
        return $this->hasOne(Profiles::class);
    }


    public function pictures()
    {
        return $this->hasMany(Pictures::class);
    }

    public function favorites()
    {
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

        'user_name',
        'email',
        'password',
        'type',
        'phone_number',
        'is_email_verified',
        'is_phone_number_verified',
        'verification_token',
        'device_notify_token',
        'status',
        'profile_picture',
        'gender',
        'profile_fill_by'
    ];


    public static function generateVerificationCode()
    {
        return Str::random(40);
    }

    public static function uniqueId()
    {
        return Str::random(4);
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',

    ];

    // public function getGender($gender)
    // {
    //     if ($gender == 1) {
    //         return User::MALE;
    //     } else if ($gender == 2) {
    //         return User::FEMALE;
    //     } else {
    //         return User::OTHER;
    //     }
    // }

    // public function getProfileFillBy($profile_fill_by)
    // {
    //     if ($profile_fill_by == 1) {
    //         return User::SELFF;
    //     } else if ($profile_fill_by == 2) {
    //         return User::PARENTT;
    //     }
    // }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
