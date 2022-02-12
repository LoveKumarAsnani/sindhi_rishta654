<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('surname')->nullable();
            $table->string('caste')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('physical_status')->nullable();
            $table->boolean('alcoholic')->nullable()->comment('1 = yes, 0 = no');
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->boolean('vegetarian')->nullable()->comment('1 = yes, 0 = no');
            $table->longText('bio')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('home_town')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('grand_father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_from')->nullable();
            $table->integer('brothers')->unsigned()->nullable();
            $table->integer('sisters')->unsigned()->nullable();
            $table->integer('brothers_married')->unsigned()->nullable();
            $table->integer('sisters_married')->unsigned()->nullable();
            $table->string('highest_education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('job_type')->nullable();
            $table->integer('salary')->unsigned()->nullable();
            $table->string('currency')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('profiles');
    }
}
