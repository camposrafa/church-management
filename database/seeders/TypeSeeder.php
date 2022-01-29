<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = json_decode(File::get(__DIR__ . '/../data/types.json'));

        foreach ($types as $typeData) {

            $type = Type::where('key_', '=', $typeData->key_)->first();
            if (is_null($type)) {
                $type = new Type();
            }

            $type->fill([
                'name' => $typeData->name,
                'key_' => $typeData->key_,
            ]);

            $type->save();
        }
    }
}
