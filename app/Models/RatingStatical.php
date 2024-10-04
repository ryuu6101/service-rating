<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RatingStatical extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'user_id',
        'client_id',
        'rating_id',
    ];

    public function rating() {
        return $this->belongsTo(Rating::class, 'rating_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
