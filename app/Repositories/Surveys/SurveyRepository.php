<?php

namespace App\Repositories\Surveys;

use App\Models\Survey;
use App\Filters\SurveyFilter;
use App\Repositories\BaseRepository;

class SurveyRepository extends BaseRepository implements SurveyRepositoryInterface
{
    public function getModel() {
        return Survey::class;
    }

    public function filter($params = [], $paginate = 0, $sort = 'asc') {
        $filter = new SurveyFilter();

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