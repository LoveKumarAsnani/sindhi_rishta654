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
            $table->string('nick_name');
            $table->string('user_name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->unique();
            $table->boolean('is_email_verified')->default(User::EMAIL_NOT_VERIFIED);
            $table->boolean('is_phone_number_verified')->default(User::PHONE_NUMBER_NOT_VERIFIED);
            $table->string('verification_token')->default(User::generateVerificationCode());
            $table->string('device_notify_token');
            $table->string('status')->default(User::USER_UN_VERFIED);
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
