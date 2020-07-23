<?php

namespace Locaravel\Models\Travels;

use Locaravel\Models\Model;

class Hotel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];


    public static function rules()
    {
        return array('code' => 'required');
    }

    /**
     * Get the rooms
     *
     * @return array
     */
    public function rooms()
    {
        return $this->aparts();
    }
    /**
     * Get the aparts
     *
     * @return array
     */
    public function aparts()
    {
        return $this->hasMany(Apart::class); //, 'hotel_id');
    }
}
