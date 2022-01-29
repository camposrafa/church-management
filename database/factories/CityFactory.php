<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->randomFloat(0, 1000000, 9999999),
            'name' => $this->faker->city,
            'lat' => $this->faker->latitude,
            'long' => $this->faker->longitude,
            'capital' => $this->faker->randomElement([true, false]),
            'state_id' => State::all(['id'])->random()->id,
        ];
    }
}
