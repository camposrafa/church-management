<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cities = json_decode(File::get(__DIR__ . '/../data/cities.json'));

        $startTime = microtime(true);

        foreach ($cities as $key => $cityData) {

            $percent = ($key + 1) / count($cities) * 100;

            $city = City::where('code', '=', $cityData->codigo_ibge)->first();
            if (is_null($city)) {
                $city = new City();
            }

            $state = State::where('code', '=', $cityData->codigo_uf)->first();

            $city->fill([
                'code' => $cityData->codigo_ibge,
                'name' => $cityData->nome,
                'lat' => $cityData->latitude,
                'long' => $cityData->longitude,
                'capital' => $cityData->capital,
                'state_id' => $state->id,
            ]);

            $city->save();

            if (fmod($percent, 1) === 0.00) {
                $runTime = round(microtime(true) - $startTime, 2);
                $this->command->getOutput()->writeln("<comment>Seeding:</comment> " . get_class($this) . " ({$runTime} seconds) ({$percent} percent)");
                $startTime = microtime(true);
            }
        }
    }
}
