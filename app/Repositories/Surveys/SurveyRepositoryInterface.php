<?php

namespace App\Repositories\Surveys;

use App\Repositories\RepositoryInterface;

interface SurveyRepositoryInterface extends RepositoryInterface
{
    public function filter($params = [], $paginate = 0, $sort = 'asc');
    public function updateOrCreate($search, $params);
    public function getByUserId($id);
}