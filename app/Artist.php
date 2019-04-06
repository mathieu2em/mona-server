<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'collective',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'pivot',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'collective' => 'boolean',
    ];

    /**
     * Get the artist's first name.
     *
     * @return string
     */
    public function getFirstNameAttribute()
    {
        return $this->collective ? null : explode(' ', $this->name, 2)[0];
    }

    /**
     * Get the artist's last name.
     *
     * @return string
     */
    public function getLastNameAttribute()
    {
        if ($this->collective)
            return null;
        return explode(' ', $this->name, 2)[1] ?? null;
    }

    /**
     * Get the artist's collective name.
     *
     * @return string
     */
    public function getCollectiveNameAttribute()
    {
        return $this->collective ? $this->name : null;
    }
}
