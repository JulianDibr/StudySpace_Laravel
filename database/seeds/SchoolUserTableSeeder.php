<?php

use Illuminate\Database\Seeder;

class SchoolUserTableSeeder extends Seeder {
    public function run() {
        DB::table('school_user')->delete();
        DB::table('school_user')->insert([
            [
                'school_id' => 1,
                'user_id' => 1,
            ],
            [
                'school_id' => 1,
                'user_id' => 2,
            ],
        ]);
    }
}
