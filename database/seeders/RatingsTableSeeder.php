<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['title' => 'Rất hài lòng'],
            ['title' => 'Hài lòng'],
            ['title' => 'Không hài lòng'],
        ];

        Rating::truncate();
        Rating::insert($data);
    }
}
