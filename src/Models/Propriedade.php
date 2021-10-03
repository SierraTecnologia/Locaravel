<?php
/**
 * FAzer.. Cada Propriedade Tem um Endereço @todo
 */

namespace Locaravel\Models;

use Locaravel\Models\Model;

class Propriedade extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propriedade_type_id',
        'content',
        'description',
        'observation',
        'propriedade_id',
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
        return $query->where('propriedade_id', null);
    }
    public function scopePropriedadesByFather($query, $value)
    {
        return $query->where('propriedade_id', $value);
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
     * Get the propriedadeType that owns the phone.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function propriedadeType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PropriedadeType::class);
    }
    
        
    /**
     * Get all of the owning propriedadeable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function propriedadeable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

}
