<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pokemon;
use App\Models\Team;

// use Illuminate\Support\Str;

class PokemonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pokemon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'base_exp' => $this->faker->numberBetween($min = 40, $max = 500),
            'picture' => $this->faker->imageUrl($width = 640, $height = 480),
            'team_id' => Team::factory()
        ];
    }
}
