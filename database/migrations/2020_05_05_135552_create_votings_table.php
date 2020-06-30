<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotingsTable extends Migration
{
    public function up()
    {
        Schema::create('votings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('posting_id');
            $table->boolean('is_upvote');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('posting_id')->references('id')->on('postings');
        });
    }

    public function down()
    {
        Schema::dropIfExists('votings');
    }
}
