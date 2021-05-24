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
     * @return array
     */
    public function places()
    {
        return $this->hasMany(Place::class); //, 'hotel_id');
    }
}
