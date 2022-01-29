<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MemberOccupation;
use App\Models\Member;
use App\Models\Occupation;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Integer;

class MemberOccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            MemberOccupation::factory()->count(5)->create();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
