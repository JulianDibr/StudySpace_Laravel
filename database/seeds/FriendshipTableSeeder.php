<?php

use Illuminate\Database\Seeder;

class FriendshipTableSeeder extends Seeder {
    public function run() {
        DB::table('friendships')->delete();
        DB::table('friendships')->insert([
            [
                'sender_type' => 'App\User',
                'sender_id' => '1',
                'recipient_type' => 'App\User',
                'recipient_id' => '2',
                'status' => '1',
            ],
            [
                'sender_type' => 'App\User',
                'sender_id' => '1',
                'recipient_type' => 'App\User',
                'recipient_id' => '3',
                'status' => '1',
            ],
            [
                'sender_type' => 'App\User',
                'sender_id' => '1',
                'recipient_type' => 'App\User',
                'recipient_id' => '8',
                'status' => '1',
            ],
            [
                'sender_type' => 'App\User',
                'sender_id' => '1',
                'recipient_type' => 'App\User',
                'recipient_id' => '12',
                'status' => '1',
            ],
        ]);
    }
}
