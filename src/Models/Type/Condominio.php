<?php

namespace Locaravel\Models\Type;

use Locaravel\Questions\Perguntas\QuantosPrediosExistem;
use Locaravel\Questions\ResponseTypes\Inteiro;
use Locaravel\Models\Model;

/**
 * Class Condominio.
 *
 * @property int id
 * @property string value
 * @property Collection posts
 * @package  Locaravel\Models
 */
class Condominio extends AddressType
{
    public static $DEFAULT_ID = 3;
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
        return 'Condominio';
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
            Residencia::class,
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
