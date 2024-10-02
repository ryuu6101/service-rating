<?php

namespace App\Repositories\Servings;

use App\Models\Serving;
use App\Filters\ServingFilter;
use App\Repositories\BaseRepository;

class ServingRepository extends BaseRepository implements ServingRepositoryInterface
{
    public function getModel() {
        return Serving::class;
    }

    public function filter($params = [], $paginate = 0, $sort = 'asc') {
        $filter = new ServingFilter();

        $list = $this->model->filter($filter, $params)->orderBy('created_at', $sort);

        if ($paginate > 0) return $list->paginate($paginate);
        else return $list->get();
    }

    public function updateOrCreate($search, $params) {
        $this->model->updateOrCreate($search, $params);
    }

    public function getByUserId($id) {
        return $this->model->where('user_id', $id)->get()->first();
    }
}