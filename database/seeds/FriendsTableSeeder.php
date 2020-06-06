<?php

use Illuminate\Database\Seeder;

class FriendsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('friends')->delete();
        DB::table('friends')->insert([
            [
                'user_1' => 1,
                'user_2' => 2,
                'accepted' => true,
            ],
        ]);
    }
}
