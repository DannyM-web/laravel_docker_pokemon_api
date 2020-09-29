<?php

namespace Database\Factories;

use App\Models\Pending;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PendingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pending::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email'=> $this->faker->email,
            'user_id'=> 2,
            'status_id'=> 2
        ];
    }
}
