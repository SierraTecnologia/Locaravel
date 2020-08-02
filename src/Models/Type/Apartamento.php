<?php

namespace Locaravel\Models\Type;

use Locaravel\Questions\Perguntas\QuantosPrediosExistem;
use Locaravel\Questions\ResponseTypes\Inteiro;
use Locaravel\Models\Model;

/**
 * Class Apartamento.
 *
 * @property int id
 * @property string value
 * @property Collection posts
 * @package  Locaravel\Models
 */
class Apartamento extends AddressType
{
    const CODE = 7;

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
        return 'Apartamento';
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
            
        ];
    }

    public function extraAtributes()
    {
        
    }


}
