<?php

namespace Database\Factories;

use App\Models\Post;
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
        $postIds = Post::pluck('id')->all();

        return [
            'user_id' => Arr::random($userIds),
            'post_id' => Arr::random($postIds),
            'content' => fake()->paragraph(),
            'created_at' => fake()->dateTimeBetween(date('Y-m-d', strtotime('-2 week')), now()),
        ];
    }
}
