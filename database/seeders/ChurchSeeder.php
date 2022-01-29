<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Church;

class ChurchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Church::factory()->count(5)->create();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
