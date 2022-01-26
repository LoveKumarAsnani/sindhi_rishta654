<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nick_name')->nullable();
            $table->string('user_name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->unique();
            $table->unsignedInteger('gender')->comment(User::MALE . ' = Male, ' . User::EMAIL_NOT_VERIFIED . ' = Female');
            $table->unsignedInteger('profile_fill_by')->comment(User::SELFF . ' = Self Fill, ' . User::PARENTT . ' = Parent Fill');
            // $table->boolean('name_visible');
            $table->string('profile_picture')->default(User::MALE_PROFILE_PICTURE);
            $table->boolean('is_email_verified')->default(User::EMAIL_NOT_VERIFIED)->comment(User::EMAIL_VERIFIED . ' = Email Verified, ' . User::EMAIL_NOT_VERIFIED . ' = Not Verified');
            $table->boolean('is_phone_number_verified')->default(User::PHONE_NUMBER_NOT_VERIFIED)->comment(User::PHONE_NUMBER_NOT_VERIFIED . ' = not verified, ' . User::PHONE_NUMBER_VERFIED . ' = Phone Number Verified');
            $table->string('verification_token')->default(User::generateVerificationCode());
            $table->string('device_notify_token');
            $table->string('status')->default(User::USER_UN_VERFIED)->comment(User::USER_UN_VERFIED . ' = Not Verified, ' . User::USER_VERFIED . ' = User Verified, ' . User::USER_BLOCK . ' = User Blocked');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
