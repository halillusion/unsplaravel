<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotosPivot extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'photos_pivot';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'photo_id',
        'raw_url',
        'full_url',
        'regular_url',
        'small_url',
        'thumb_url',
    ];
}
