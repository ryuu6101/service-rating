<?php

namespace App\Repositories\BannerImages;

use App\Models\BannerImage;
use App\Repositories\BaseRepository;

class BannerImageRepository extends BaseRepository implements BannerImageRepositoryInterface
{
    public function getModel() {
        return BannerImage::class;
    }
}