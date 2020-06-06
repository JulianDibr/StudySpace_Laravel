<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_1'); //Lower ID
            $table->unsignedBigInteger('user_2'); //Higher ID
            $table->boolean('accepted')->default(false);
            $table->timestamps();

            $table->foreign('user_1')->references('id')->on('users');
            $table->foreign('user_2')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
