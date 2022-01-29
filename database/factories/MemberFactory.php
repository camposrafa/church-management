<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\CivilState;
use App\Models\File;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    protected $model = Member::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'birth_date' => $this->faker->date(),
            'cpf' => $this->faker->randomNumber(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'email' => $this->faker->email(),
            'neighborhood' => $this->faker->name(),
            'number' => $this->faker->randomNumber(),
            'postal_code' => $this->faker->postcode(),
            'father_name' => $this->faker->name(),
            'mother_name' => $this->faker->name(),
            'spouse' => $this->faker->name(),
            'wedding_date' => $this->faker->date(),
            'qtty_sons' => $this->faker->randomNumber(),
            'civil_state_id' =>  CivilState::all(['id'])->random()->id,
            'picture_id' =>  File::all(['id'])->random()->id,
        ];
    }
}
