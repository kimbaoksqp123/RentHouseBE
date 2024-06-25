<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Review;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN'); 

        $userIds = User::pluck('id')->all();

        Review::factory()->count(60)->create()->each(function ($review) use ($userIds, $faker) {
            $content = $faker->realText(250); 
            $review->content = $content;
            $review->save();

            $review->likedUsers()->attach(Arr::random($userIds, rand(0, 5)));
        });
    }
}
