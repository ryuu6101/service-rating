<?php

namespace App\Filters;

class UserFilter extends QueryFilter
{
    protected $filterable = [
        'id',
        'username',
        'role_id',
        'is_actived',
    ];
    
    public function filterName($name) {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }
}

