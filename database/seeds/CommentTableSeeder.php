<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->delete();
        DB::table('comments')->insert([
            [
                'user_id' => 1,
                'posting_id' => 2,
                'content' => 'Isso man',
            ],
            [
                'user_id' => 2,
                'posting_id' => 2,
                'content' => 'Voll nicht',
            ],
            [
                'user_id' => 1,
                'posting_id' => 1,
                'content' => 'hahah',
            ],
        ]);
    }
}
