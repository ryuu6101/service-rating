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
            [
                'title' => 'Rất hài lòng',
                'slug' => 'rat_hai_long',
                'image_url' => 'images/emojis/Blushed.png',
            ],
            [
                'title' => 'Hài lòng',
                'slug' => 'hai_long',
                'image_url' => 'images/emojis/Smiling.png',
            ],
            [
                'title' => 'Không hài lòng',
                'slug' => 'khong_hai_long',
                'image_url' => 'images/emojis/Angry.png',
            ],
        ];

        Rating::truncate();
        Rating::insert($data);
    }
}
