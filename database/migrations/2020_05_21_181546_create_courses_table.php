<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration {
    public function up() {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('school_id');
            $table->string('name');
            $table->string('description')->nullable()->default(null);
            $table->string('abbreviation')->nullable()->default(null);
            $table->string('teacher')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->boolean('user_invite')->default(0);
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('school_id')->references('id')->on('schools');
        });
    }

    public function down() {
        Schema::dropIfExists('courses');
    }
}
