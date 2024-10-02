<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Filters\UserFilter;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel() {
        return User::class;
    }

    public function filter($params = [], $paginate = 0, $sort = 'asc') {
        $filter = new UserFilter();

        $list = $this->model->filter($filter, $params)->orderBy('created_at', $sort);

        if ($paginate > 0) return $list->paginate($paginate);
        else return $list->get();
    }
}