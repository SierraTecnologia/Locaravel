<?php

namespace Locaravel\Models\Type;

use Locaravel\Questions\Perguntas\QuantosPrediosExistem;
use Locaravel\Questions\ResponseTypes\Inteiro;
use Locaravel\Models\Address;
use Locaravel\Models\Model;

/**
 * Class Regiao.
 *
 * @property int id
 * @property string value
 * @property Collection posts
 * @package  Locaravel\Models
 */
class Regiao extends AddressType
{
    const CODE = 1;


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
        return 'Região';
    }

    public function perguntas()
    {
        return [
            QuantosPrediosExistem::class,
        ];
    }

    public function filhos()
    {
        return [
            Rua::class,
            Regiao::class,
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
