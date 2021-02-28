<?php

namespace Database\Factories;

use App\Models\Vinyl;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class VinylFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vinyl::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'author' => $this->faker->name,
            'year' => $this->faker->year,
        ];
    }
}
