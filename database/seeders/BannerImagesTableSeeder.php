<?php

namespace Database\Seeders;

use App\Models\BannerImage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'position' => 'left',
                'image_url' => 'images/Logo-CNPT-Copy-removebg-preview.png',
            ],
            [
                'id' => 2,
                'position' => 'center',
                'image_url' => 'images/image.png',
            ],
            [
                'id' => 3,
                'position' => 'right',
                'image_url' => null,
            ],
        ];

        BannerImage::truncate();
        BannerImage::insert($data);
    }
}
