<?php

namespace App\Repositories\Servings;

use App\Repositories\RepositoryInterface;

interface ServingRepositoryInterface extends RepositoryInterface
{
    public function filter($params = [], $paginate = 0, $sort = 'asc');
    public function updateOrCreate($search, $params);
    public function getByUserId($id);
}