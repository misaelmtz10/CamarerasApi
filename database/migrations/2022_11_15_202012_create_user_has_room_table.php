<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_room', function (Blueprint $table) {
            $table->id();
            $table->dateTime('started')->nullable();
            $table->dateTime('ended')->nullable();
            $table->string('observations', 1000)->nullable();
            $table->longText('evidence')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('rooms_id');
            $table->unsignedBigInteger('status_cleaning_id')->nullable();

            //create foreing key
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('rooms_id')->references('id')->on('rooms');
            $table->foreign('status_cleaning_id')->references('id')->on('status_cleaning');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_room');
    }
}
