<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('utilities')->insert([
            [
                'name' => 'Điện',
            ],
            [
                'name' => 'Nước',
            ],
            [
                'name' => 'Wi-fi',
            ],
            [
                'name' => 'Tủ lạnh',
            ],
            [
                'name' => 'Điều hòa',
            ],
            [
                'name' => 'Bàn',
            ],
            [
                'name' => 'Tủ quần áo',
            ],
            [
                'name' => 'Máy giặt',
            ],
            [
                'name' => 'Máy sấy',
            ],
            [
                'name' => 'Vệ sinh',
            ],
            [
                'name' => 'Rác thải',
            ],
            [
                'name' => 'Bếp',
            ],
        ]);
    }
}
