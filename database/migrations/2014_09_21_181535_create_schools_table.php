<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration {
    public function up() {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('profile_picture')->nullable()->default(null);
            //Address
            $table->string('street')->nullable()->default(null);
            $table->string('house_number')->nullable()->default(null);
            $table->string('zipcode')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('schools');
    }
}
