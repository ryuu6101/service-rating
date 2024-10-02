<?php

namespace App\Repositories\RatingStaticals;

use App\Repositories\RepositoryInterface;

interface RatingStaticalRepositoryInterface extends RepositoryInterface
{
    public function filter($params = [], $paginate = 0, $sort = 'asc');
}