<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\City;
use App\Models\State;
use App\Models\Church;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChurchFactory extends Factory
{
    protected $model = Church::class;

    public function definition()
    {
        return [
            'denomination' => $this->faker->name(),
            'cnpj' => $this->faker->randomNumber(),
            'phone' => $this->faker->randomNumber(),
            'responsible_name' => $this->faker->name(),
            'responsible_phone' => $this->faker->randomNumber(),
            'address' => $this->faker->address(),
            'number' => $this->faker->randomNumber(),
            'neighborhood' => $this->faker->name(),
            'zip_code' => $this->faker->postcode(),
            'city_id' =>  City::all(['id'])->random()->id,
            'state_id' => State::all(['id'])->random()->id,
            'type_id' =>  Type::all(['id'])->random()->id,
        ];
    }
}
