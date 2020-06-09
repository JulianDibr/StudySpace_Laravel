<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('posting_id');
            $table->unsignedBigInteger('comment_id')->nullable()->default(null);
            $table->integer('user_type')->nullable()->default(null);
            $table->string('content');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('posting_id')->references('id')->on('postings');
            $table->foreign('comment_id')->references('id')->on('comments');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
