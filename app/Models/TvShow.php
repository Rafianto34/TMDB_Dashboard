<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvShow extends Model
{
    protected $fillable = [
        'tmdb_id',
        'name',
        'first_air_date',
        'genre',
        'popularity',
        'vote_average',
        'poster_path',
        'overview',
    ];
}
