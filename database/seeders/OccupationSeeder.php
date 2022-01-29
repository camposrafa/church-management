<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Occupation;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Occupation::factory()->count(5)->create();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
