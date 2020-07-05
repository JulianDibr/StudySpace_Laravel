<?php

use Illuminate\Database\Seeder;

class CourseUserTableSeeder extends Seeder {
    public function run() {
        DB::table('course_user')->delete();
        DB::table('course_user')->insert([
            ['course_id' => 1, 'user_id' => 1],
            ['course_id' => 2, 'user_id' => 1],
            ['course_id' => 3, 'user_id' => 1],
            ['course_id' => 4, 'user_id' => 1],
            ['course_id' => 5, 'user_id' => 1],
            ['course_id' => 6, 'user_id' => 1],
            ['course_id' => 7, 'user_id' => 1],
            ['course_id' => 8, 'user_id' => 1],
            ['course_id' => 1, 'user_id' => 2],
        ]);
    }
}
