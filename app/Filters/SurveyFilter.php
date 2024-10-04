<?php

namespace App\Filters;

class SurveyFilter extends QueryFilter
{
    protected $filterable = [
        'id',
        'user_id',
        'client_id',
    ];
}

