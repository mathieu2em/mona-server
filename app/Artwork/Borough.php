<?php

namespace App\Artwork;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Borough extends Model
{
    use SpatialTrait;

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'abbr', 'name',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /*
     * The attributes that are spatial representations.
     *
     * @var array
     */
    protected $spatialFields = [
        'area',
    ];
}
