<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->all();

        Review::factory()->count(60)->create()->each(function ($review) use ($userIds) {
            $review->likedUsers()->attach(Arr::random(
                $userIds,
                rand(0, 5)
            ));
        });
    }
}
