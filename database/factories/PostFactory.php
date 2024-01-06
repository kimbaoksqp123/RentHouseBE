<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => fake()->numberBetween(2, 6) * 1000000,
            'land_area' => fake()->numberBetween(20,30),
            'type' => fake()->numberBetween(1,3),
            'view_number' => fake()->numberBetween($min = 100, $max = 10000),
            'description' => fake()->realText(),
            'bedroom_num' => fake()->numberBetween(1, 3),
            'bathroom_num' => fake()->numberBetween(1,2),
        ];
    }
}
