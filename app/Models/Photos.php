<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'photo_id',
        'artist_id',
        'color',
        'description',
        'likes',
        'location',
    ];
}
