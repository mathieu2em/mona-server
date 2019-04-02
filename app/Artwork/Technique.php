<?php

namespace App\Artwork;

use Illuminate\Database\Eloquent\Model;

class Technique extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fr', 'en',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'fr', 'en',
    ];
}
