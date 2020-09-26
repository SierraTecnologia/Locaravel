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

    /**
     * Get the aparts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @psalm-return \Illuminate\Database\Eloquent\Relations\HasMany<Apart>
     */
    public function aparts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Apart::class); //, 'hotel_id');
    }
}
