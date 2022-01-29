<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    public function definition()
    {

        $faker_folder = "faker";
        if (!Storage::exists($faker_folder)) {
            Storage::makeDirectory($faker_folder);
        }

        $fakerImages = Storage::files($faker_folder);

        if (count($fakerImages) >= 5) {
            $image_path = $this->faker->randomElement($fakerImages);
        } else {
            $image_path = join('/', [$faker_folder, $this->faker->image(Storage::disk()->getAdapter()->getPathPrefix() . $faker_folder, 512, 512, null, false)]);
        }

        $img_info = getimagesize(Storage::disk()->getAdapter()->getPathPrefix() . $image_path);

        return [
            'description' => $this->faker->words(5, true),
            'path' => $image_path,
            'type' => $img_info['mime'],
        ];
    }
}
