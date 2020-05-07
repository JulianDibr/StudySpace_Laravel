<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('postings')->delete();
        DB::table('postings')->insert([
            [
                'user_id' => 1,
                'content' => 'Dies ist ein Testpost',
                'location_id' => 1,
                'location_type' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'content' => 'Dies ist ein weiterer Testpost',
                'location_id' => 1,
                'location_type' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'content' => 'Dies ist ein weiterer Testpost',
                'location_id' => 1,
                'location_type' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'content' => 'Dies ist ein weiterer Testpost',
                'location_id' => 1,
                'location_type' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
