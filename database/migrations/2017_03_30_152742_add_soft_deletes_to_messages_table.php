<?php

use Cmgmyr\Messenger\Models\Models;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToMessagesTable extends Migration {
    public function up() {
        Schema::table(Models::table('messages'), function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::table(Models::table('messages'), function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
