<?php

namespace App\Filters;

class ServingFilter extends QueryFilter
{
    protected $filterable = [
        'id',
        'user_id',
        'client_id',
    ];
}

