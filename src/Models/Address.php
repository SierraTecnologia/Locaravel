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
 
    /**
     * Get the owning addresseable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addresseable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function addressType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AddressType::class);
    }

    /**
     * Get the post's localization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function localization(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne('Locaravel\Models\Localization', 'localizationable');
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

        // Implementar Cep
        if (isset($data['cep'])) {

            // {#1974
            //     +"cep": "22460-030"
            //     +"logradouro": "Rua Pacheco Leão"
            //     +"complemento": "até 914/915"
            //     +"bairro": "Jardim Botânico"
            //     +"localidade": "Rio de Janeiro"
            //     +"uf": "RJ"
            //     +"ibge": "3304557"
            //     +"gia": ""
            //     +"ddd": "21"
            //     +"siafi": "6001"
            //   }
            // $cepService = new \Locaravel\Saas\CorreiosService();
            // $cepResult = $cepService->validateCep($request->get('cep'));
        }

        //
        $last = false;
        if (isset($data['region'])) {
            if (!$region = Address::where('address_type_id', Regiao::CODE)->where('content', $data['region'])->first()) {
                $region = Address::create(
                    [
                    'address_type_id' => Regiao::CODE,
                    'content' => $data['region'],
                    ]
                );
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
