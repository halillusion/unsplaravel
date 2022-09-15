<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'photos';

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

    public function pivot()
    {
        return $this->hasManyThrough(PhotosPivot::class, 'photo_id');
    }

    public function artist()
    {
        return $this->belongsTo(Artists::class, 'artist_id', 'artist_id');
    }
}
