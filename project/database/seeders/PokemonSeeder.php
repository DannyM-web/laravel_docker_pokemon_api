<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pokemon::factory(20)
                ->has(Type::factory()->count(1))
                ->has(Ability::factory()->count(3))           
                ->create();
    }
}
