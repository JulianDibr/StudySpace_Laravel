<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {
    public function run() {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'first_name' => 'Julian',
                'last_name' => 'Dibrani',
                'email' => 'JulianDibr@gmail.com',
                'password' => '$2y$10$hhtgmsKAyhnIUXlyLfZiyu0L4A.o0bz4Agj8s0DKjRbESXmj0KEP.',
                'profile_picture' => 'profile_0001.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'school_id' => 1,
            ],
            [
                'first_name' => 'Julian1',
                'last_name' => 'Dibrani1',
                'email' => 'JulianDibr1@gmail.com',
                'password' => '$2y$10$hhtgmsKAyhnIUXlyLfZiyu0L4A.o0bz4Agj8s0DKjRbESXmj0KEP.',
                'profile_picture' => 'profile_0002.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'school_id' => 1,
            ],
            [
                'first_name' => 'Test',
                'last_name' => 'Mensch',
                'email' => 'Test@gmail.com',
                'password' => '$2y$10$hhtgmsKAyhnIUXlyLfZiyu0L4A.o0bz4Agj8s0DKjRbESXmj0KEP.',
                'profile_picture' => 'profile_0003.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'school_id' => 2,
            ],
        ]);
    }
}
