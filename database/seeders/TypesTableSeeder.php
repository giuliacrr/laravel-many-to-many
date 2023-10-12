<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TypesTableSeeder extends Seeder
{
    public function run(Faker $faker): void {
        $types = ['FrontEnd', 'Backend', 'FullStack'];

        foreach ($types as $type) {
            $new_type = new Type();
            $new_type->name = $type;
            $new_type->color = $faker->rgbColor();
            $new_type->save();
        }
    }
}
