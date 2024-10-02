<?php

namespace App\Repositories\RatingStaticals;

use App\Models\RatingStatical;
use App\Repositories\BaseRepository;
use App\Filters\RatingStaticalFilter;

class RatingStaticalRepository extends BaseRepository implements RatingStaticalRepositoryInterface
{
    public function getModel() {
        return RatingStatical::class;
    }

    public function filter($params = [], $paginate = 0, $sort = 'asc') {
        $filter = new RatingStaticalFilter();

        $list = $this->model->filter($filter, $params)->orderBy('created_at', $sort);

        if ($paginate > 0) return $list->paginate($paginate);
        else return $list->get();
    }
}