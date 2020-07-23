<?php

namespace Locaravel\Models\Type;
use Locaravel\Models\Model;
use Locaravel\Models\Address;

class AddressType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
    ];

    protected $mappingProperties = array(
        'category_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    public static $TYPES = [
        Regiao::class,
        Rua::class,
        Condominio::class,
        Predio::class,
        Casa::class,
        Apartamento::class,
    ];
    public static function createTodosPadroes()
    {
        collect(self::$TYPES)->each(
            function ($class) {
                $instanceFeature = new $class;
                $id = $instanceFeature::$DEFAULT_ID;
                AddressType::firstOrCreate(
                    [
                    'id'                => $id,
                    'name'              => $instanceFeature->getName(),
                    'type'              => $class,
                    ]
                );
            }
        );
    }

    public static function registerOrReturnAddress($data)
    {
        $find = [];
        // @todo fazerui aqui
        if (isset($data['content'])) {
            $find = [
                'content' => $data['content'],
                'address_type_id' => static::$DEFAULT_ID,
            ];
        }

        if (isset($data['address_id'])) {
            $find['address_id'] = $data['address_id'];
        }

        if (empty($find)) {
            return null;
        }

        if (!$address = Address::where($find)->first()) {
            if (isset($data['description'])) { $find['description'] = $data['description'];
            }
            if (isset($data['observation'])) { $find['observation'] = $data['observation'];
            }
            $address = Address::create(
                $find
            );
        }

        if (isset($data['extra_atributes'])) {
            self::getExtraAtributes($data['extra_atributes'], $address);
        }

        return $address;
    }

    protected static function getExtraAtributes($data, $referencia)
    {
        if (empty($data)) {
            return true;
        }
        $fields = static::extraImutableAtributes();
        foreach ($data as $indice=>$valor) {
            if (isset($fields[$indice])) {
                $fields[$indice]['result']($valor, $referencia);
            }
        }
    }
    
}
