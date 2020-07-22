<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        $this->call(SchoolTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PostingsTableSeeder::class);
        $this->call(VotingsTableSeeder::class);
        $this->call(CommentTableSeeder::class);

        //Factories
        factory(App\User::class, 50)->create();
        factory(App\Course::class, 15)->create();

        //Pivot
        $this->call(CourseUserTableSeeder::class);
        $this->call(FriendshipTableSeeder::class);
    }
}
