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
     * @return string[]
     *
     * @psalm-return array{code: 'required'}
     */
    public static function rules(): array
    {
        return array('code' => 'required');
    }

    /**
     * Get the rooms
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->aparts();
    }
    /**
     * Get the aparts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aparts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Apart::class); //, 'hotel_id');
    }
}
