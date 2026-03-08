<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'tmdb_id',
        'name',
        'known_for_department',
        'popularity',
        'profile_path',
        'biography',
    ];
}
