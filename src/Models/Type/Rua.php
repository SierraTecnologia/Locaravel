<?php

namespace Locaravel\Models\Type;

use Locaravel\Questions\Perguntas\QuantosPrediosExistem;
use Locaravel\Questions\ResponseTypes\Inteiro;
use Locaravel\Models\Model;

/**
 * Class Rua.
 *
 * @property int id
 * @property string value
 * @property Collection posts
 * @package  Locaravel\Models
 */
class Rua extends AddressType
{
    const CODE = 2;


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
        return 'Rua';
    }

    public function perguntas()
    {
        return [

        ];
    }

    public static function returnOrRegisterStreet()
    {

    }

    public function filhos()
    {
        return [
            Casa::class,
            Condominio::class,
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
