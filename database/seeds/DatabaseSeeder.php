<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(SchoolTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PostingsTableSeeder::class);
        $this->call(VotingsTableSeeder::class);
        $this->call(CommentTableSeeder::class);

        //Pivot
        $this->call(SchoolUserTableSeeder::class);
    }
}
