<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration {
    public function up() {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('name');
            $table->string('description')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->boolean('user_invite')->default(0);
            $table->boolean('is_open')->default(0);
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::dropIfExists('groups');
    }
}
