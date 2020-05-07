<?php

use Illuminate\Database\Seeder;

class VotingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('votings')->delete();
        DB::table('votings')->insert([
            [
                'user_id' => 1,
                'posting_id' => 1,
                'is_upvote' => true,
            ],
            [
                'user_id' => 2,
                'posting_id' => 1,
                'is_upvote' => false,
            ],
            [
                'user_id' => 1,
                'posting_id' => 2,
                'is_upvote' => true,
            ],
        ]);
    }
}
