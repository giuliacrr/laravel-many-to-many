<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    public function run(): void
    {
        $techs = ['Vue', 'React', 'JS', 'TS', 'CSS', "SCSS", "Bootstrap", "Tailwind", "PHP", "Laravel", "NodeJs"];

        foreach ($techs as $tech) {
            Technology::create([
                'name' => $tech,
            ]);
        }
    }
}