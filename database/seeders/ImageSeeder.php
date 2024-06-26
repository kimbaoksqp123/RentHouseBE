<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                DB::table('images')->insert([
                    'post_id' => $i,
                    'url' => "https://renthouse20194486.s3.ap-southeast-2.amazonaws.com/houses/{$i}_anh{$j}.jpg",
                ]);
            }
        }
    }
}
