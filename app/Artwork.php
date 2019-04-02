<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Artwork extends Model
{
    use SpatialTrait;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dimensions' => 'array',
    ];

    /*
     * The attributes that are spatial representations.
     *
     * @var array
     */
    protected $spatialFields = [
        'location',
    ];

    /**
     * Get the artwork's location.
     *
     * @param  object  $value
     * @return object
     */
    public function getLocationAttribute($value)
    {
        return (object) [
            'lat' => $value->getLat(),
            'lng' => $value->getLng(),
        ];
    }

    /**
     * Get the category that owns the artwork.
     */
    public function category()
    {
        return $this->belongsTo('App\Artwork\Category');
    }

    /**
     * Get the subcategory that owns the artwork.
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Artwork\Subcategory');
    }

    /**
     * Get the borough that owns the artwork.
     */
    public function borough()
    {
        return $this->belongsTo('App\Artwork\Borough');
    }

    /**
     * The materials that belong to the artwork.
     */
    public function materials()
    {
        return $this->belongsToMany('App\Artwork\Material');
    }

    /**
     * The techniques that belong to the artwork.
     */
    public function techniques()
    {
        return $this->belongsToMany('App\Artwork\Technique');
    }

    /**
     * The artists that belong to the artwork.
     */
    public function artists()
    {
        return $this->belongsToMany('App\Artist');
    }
}
