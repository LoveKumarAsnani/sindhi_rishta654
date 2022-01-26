<?php

use App\Models\Friends;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('friend_user_id');
            $table->unique(['user_id', 'friend_user_id']);
            $table->foreign('friend_user_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('status')->default(Friends::NEWW);
            $table->dateTime('request_date');
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
        Schema::dropIfExists('friends');
    }
}
