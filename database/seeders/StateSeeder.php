<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = json_decode(File::get(__DIR__ . '/../data/states.json'));

        foreach ($states as $stateData) {

            $state = State::where('code', '=', $stateData->codigo_uf)->first();
            if (is_null($state)) {
                $state = new State();
            }

            $state->fill([
                'code' => $stateData->codigo_uf,
                'abbreviation' => $stateData->uf,
                'name' => $stateData->nome,
                'lat' => $stateData->latitude,
                'long' => $stateData->longitude,
            ]);

            $state->save();
        }
    }
}
