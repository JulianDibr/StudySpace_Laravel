<?php

use Illuminate\Database\Seeder;

class SchoolTableSeeder extends Seeder {
    public function run() {
        DB::table('schools')->delete();
        DB::table('schools')->insert([
            [
                'name' => 'Hochschule Hamm-Lippstadt (Lippstadt)',
                'street' => 'Dr.-Arnold-Hueck-Straße',
                'house_number' => '3',
                'zipcode' => '59557 ',
                'city' => 'Lippstadt',
                'phone' => '02381 8789234',
                'profile_picture' => 'school_0001.jpg',
            ],
            [
                'name' => 'Hochschule Hamm-Lippstadt (Hamm)',
                'street' => 'Marker Allee',
                'house_number' => '76-78',
                'zipcode' => '59063',
                'city' => 'Hamm',
                'phone' => '02381 8789234',
                'profile_picture' => 'school_0001.jpg',
            ],
            [
                'name' => 'Uni Dortmund',
                'street' => null,
                'house_number' => null,
                'zipcode' => null,
                'city' => null,
                'phone' => null,
                'profile_picture' => null,
            ],
        ]);
    }
}
