<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Serving extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'user_id',
        'client_id',
    ];
}
