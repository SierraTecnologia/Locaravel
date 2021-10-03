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
     * @return string[]
     *
     * @psalm-return array{code: 'required'}
     */
    public static function rules(): array
    {
        return array('code' => 'required');
    }

    /**
     * Hotel
     *
     * @return Relationship
     */


    /**
     * Get the hotel that owns the phone.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hotel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

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
