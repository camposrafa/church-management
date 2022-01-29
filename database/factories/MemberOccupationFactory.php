<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\Member;
use App\Models\Occupation;
use App\Models\MemberOccupation;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberOccupationFactory extends Factory
{
    protected $model = MemberOccupation::class;
    public function definition()
    {
        return [
            'member_id' => Member::all(['id'])->random()->id,
            'occupation_id' => Occupation::all(['id'])->random()->id,
        ];
    }
}
