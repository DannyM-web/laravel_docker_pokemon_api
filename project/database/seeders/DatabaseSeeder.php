<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PokemonSeeder;
use Database\Seeders\TeamSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PokemonSeeder::class,      
            TeamSeeder::class
        ]);
    }
}
