<?php

namespace Database\Seeders;

use CivilState;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // StateSeeder::class,
            // CitySeeder::class,
            // TypeSeeder::class,
            ChurchSeeder::class,
            // CivilStateSeeder::class,
            // MemberSeeder::class,
            MemberOccupationSeeder::class,
            OccupationSeeder::class,
            // FileSeeder::class,
        ]);
    }
}
