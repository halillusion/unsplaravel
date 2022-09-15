<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artists extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'artist_id',
        'username',
        'name',
        'bio',
        'location',
        'link'
    ];
}
