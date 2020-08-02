<?php

namespace Locaravel\Models;

use Locaravel\Models\Model;
use Locaravel\Models\Type\AddressType;
use Locaravel\Models\Type\Apartamento;
use Locaravel\Models\Type\Bloco;
use Locaravel\Models\Type\Casa;
use Locaravel\Models\Type\Condominio;
use Locaravel\Models\Type\Predio;
use Locaravel\Models\Type\Regiao;
use Locaravel\Models\Type\Rua;

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


    /**
     * Gera uma Nova Notificação para o Alvo
     *
     * @param  [type] $target
     * @param  [type] $typeEmergency
     * @param  array  $data
     * @return void
     */
    public static function create($data)
    {
        AddressType::createTodosPadroes();
        $last = false;
        if (isset($data['region'])) {
            if (!$region = Address::where('address_type_id', Regiao::CODE)->where('content', $data['region'])->first()) {
                $region = Address::create([
                    'address_type_id' => Regiao::CODE,
                    'content' => $data['region'],
                ]);
            }
            $last = $region;
        }
        if (isset($data['street'])) {
            if (!$rua = Address::where('address_type_id', Rua::CODE)->where('content', $data['street'])->first()) {
                $inputData = [
                    'address_type_id' => Rua::CODE,
                    'content' => $data['street'],
                ];
                if (isset($region) && is_object($region)) {
                    $inputData['parent_id'] = $region->id;
                }
                $rua = Address::create($inputData);
            }
            $last = $rua;
        }
        if (isset($data['num'])) {
            if (!$casa = Address::where('address_type_id', Casa::CODE)->where('content', $data['num'])->first()) {
                $inputData = [
                    'address_type_id' => Casa::CODE,
                    'content' => $data['street'],
                ];
                if (isset($rua) && is_object($rua)) {
                    $inputData['parent_id'] = $rua->id;
                }
                $casa = Address::create($inputData);
            }
            $last = $casa;
        }
        if (!$last) {
            return ;
        }
        
        parent::create($data);
        return ;
    }

}
