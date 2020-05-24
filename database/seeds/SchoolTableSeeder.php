<?php

use Illuminate\Database\Seeder;

class SchoolTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('schools')->delete();
        DB::table('schools')->insert([
            [
                'name' => 'Hochschule Hamm-Lippstadt',
            ],
            [
                'name' => 'Uni Dortmund',
            ],
        ]);
    }
}
