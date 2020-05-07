<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'first_name' => 'Julian',
                'last_name' => 'Dibrani',
                'email' => 'JulianDibr@gmail.com',
                'password' => '$2y$10$hhtgmsKAyhnIUXlyLfZiyu0L4A.o0bz4Agj8s0DKjRbESXmj0KEP.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'first_name' => 'Test',
                'last_name' => 'Mensch',
                'email' => 'Test@gmail.com',
                'password' => '$2y$10$hhtgmsKAyhnIUXlyLfZiyu0L4A.o0bz4Agj8s0DKjRbESXmj0KEP.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
