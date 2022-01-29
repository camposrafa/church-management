<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\Occupation;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class OccupationFactory extends Factory
{
    protected $model = Occupation::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'desc' => $this->faker->text(),
            'date_consecration' => $this->faker->date(),
            'locale_consecration' => $this->faker->text(),
            'consecrated_by' => $this->faker->name(),
            'date_conversion' => $this->faker->date(),
            'locale_conversion' => $this->faker->name(),
            'date_baptism' => $this->faker->date(),
            'locale_baptism' => $this->faker->name(),
            'date_admission' => $this->faker->date(),
            'admission_by' => $this->faker->name(),
        ];
    }
}
