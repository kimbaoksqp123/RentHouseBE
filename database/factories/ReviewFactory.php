<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->all();
        $houseIds = House::pluck('id')->all();

        return [
            'user_id' => Arr::random($userIds),
            'house_id' => Arr::random($houseIds),
            'content' => fake()->paragraph(),
            'created_at' => fake()->dateTimeBetween(date('Y-m-d', strtotime('-2 week')), now()),
        ];
    }
}
