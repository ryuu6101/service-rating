<?php

namespace App\Filters;

use Carbon\Carbon;

class RatingStaticalFilter extends QueryFilter
{
    protected $filterable = [
        'id',
        'user_id',
        'client_id',
        'rating_id',
        'recent',
    ];

    public function filterFromDate($date) {
        $date = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        return $this->builder->whereDate('created_at', '>=', $date);
    }

    public function filterToDate($date) {
        $date = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        return $this->builder->whereDate('created_at', '<=', $date);
    }
}

