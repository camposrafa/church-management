<?php

namespace Database\Factories;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class StateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = State::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->randomFloat(0, 10, 99),
            'abbreviation' => $this->faker->stateAbbr,
            'name' => $this->faker->state,
            'lat' => $this->faker->latitude,
            'long' => $this->faker->longitude,
        ];
    }
}
