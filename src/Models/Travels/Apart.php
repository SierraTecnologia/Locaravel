<?php

namespace Locaravel\Models\Travels;

use Locaravel\Models\Model;

class Apart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'hotel_id',
    ];

    


    /**
     * Hotel
     *
     * @return Relationship
     */


    // /**
    //  * Get the travels @todo Rever isso aqui
    //  *
    //  * @return array
    //  */
    // public function travels()
    // {
    //     return $this->hasMany(Travel::class, 'apart_id');
    // }
}
