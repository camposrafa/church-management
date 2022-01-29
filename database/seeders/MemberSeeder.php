<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use Illuminate\Support\Integer;
use Illuminate\Support\Facades\File;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Member::factory()->count(5)->create();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
