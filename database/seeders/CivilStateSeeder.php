<?php

namespace Database\Seeders;

use App\Models\CivilState;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CivilStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $civilStates = json_decode(File::get(__DIR__ . '/../data/civil_state.json'));

        foreach ($civilStates as $civilStateData) {

            $civilState = CivilState::where('description', '=', $civilStateData->description)->first();
            if (is_null($civilState)) {
                $civilState = new CivilState();
            }

            $civilState->fill([
                'description' => $civilStateData->description,
            ]);

            $civilState->save();
        }
    }
}
