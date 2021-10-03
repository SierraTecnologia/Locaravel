<?php

namespace Locaravel\Models\Travels;

use Locaravel\Models\Model;
use Locaravel\Models\Travels\Place;

class PlaceType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        // 'type',
    ];

    
    /**
     * Get the places
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function places(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Place::class); //, 'hotel_id');
    }
}
