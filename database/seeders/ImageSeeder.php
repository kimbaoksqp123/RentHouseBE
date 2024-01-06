<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <= 30; $i++) {
            for($j=1; $j <= 4; $j++) {
                DB::table('images')->insert(
                [
                    'post_id' => $i,
                    'url' => "image\\$i\\anh$j.jpg",
                ]);
            }
        }
    }
}
