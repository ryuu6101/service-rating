<?php

namespace App\Repositories\Ratings;

use App\Models\Rating;
use App\Repositories\BaseRepository;

class RatingRepository extends BaseRepository implements RatingRepositoryInterface
{
    public function getModel() {
        return Rating::class;
    }
}