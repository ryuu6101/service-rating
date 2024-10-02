<?php

namespace App\Repositories\Users;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function filter($params = [], $paginate = 0, $sort = 'asc');
}