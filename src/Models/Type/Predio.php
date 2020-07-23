<?php

namespace Locaravel\Models\Type;

use Locaravel\Questions\Perguntas\QuantosPrediosExistem;
use Locaravel\Questions\ResponseTypes\Inteiro;
use Locaravel\Models\Model;

/**
 * Class Predio.
 *
 * @property int id
 * @property string value
 * @property Collection posts
 * @package  Locaravel\Models
 */
class Predio extends AddressType
{
    public static $DEFAULT_ID = 4;

    /**
     * @inheritdoc
     */
    public $timestamps = false;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'value',
    ];

    public function getName()
    {
        return 'Predio';
    }

    public function perguntas()
    {
        return [
            QuantasPessoasMoramAqui::class,
        ];
    }

    public static function extraImutableAtributes()
    {
        return [
            // 'andares'
            // 'apart'
            'blocos' => [
                'name' => 'Número de Blocos',
                // 'type' => Integer::class,
                // 'children' => Bloco::extraImutableAtributes(),
                'result' => function ($result, $parent) {
                    foreach ($result as $indice=>$valor) {
                        $data = [
                            'content' => (string) $indice,
                            'description' => 'Bloco '.$indice,
                            'address_id' => $parent->id,
                            'extra_atributes' => $valor
                        ];
                        $bloco = Bloco::registerOrReturnAddress($data);
                    }
                }
            ]
        ];
    }

    public function extraAtributes()
    {
        
    }

}
