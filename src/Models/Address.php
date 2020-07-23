<?php

namespace Locaravel\Models;

use Locaravel\Models\Model;
use Locaravel\Models\Type\AddressType;

class Address extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_type_id',
        'content',
        'description',
        'observation',
        'address_id',
        'category_id',
    ];

    protected $mappingProperties = array(
        'category_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
        /**
         * Produtos visíveis
         *
         * @param  \Illuminate\Database\Eloquent\Builder $query
         * @return \Illuminate\Database\Eloquent\Builder
         */
    public function scopeSempai($query)
    {
        return $query->where('address_id', null);
    }
    public function scopeAddressesByFather($query, $value)
    {
        return $query->where('address_id', $value);
    }
 
 
    // /**
    //  * Produtos acima de R$ 1
    //  *
    //  * @param \Illuminate\Database\Eloquent\Builder $query
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeExpensivePrice($query)
    // {
    //     return $query->where('price', '>', 1);
    // }


    /**
     * Get the addressType that owns the phone.
     */
    public function addressType()
    {
        return $this->belongsTo(AddressType::class);
    }

}
