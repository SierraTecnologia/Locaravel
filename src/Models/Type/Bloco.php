<?php

namespace Locaravel\Models\Type;

use Locaravel\Questions\Perguntas\QuantosPrediosExistem;
use Locaravel\Questions\ResponseTypes\Inteiro;
use Locaravel\Models\Model;

/**
 * Class Bloco.
 *
 * @property int id
 * @property string value
 * @property Collection posts
 * @package  Locaravel\Models
 */
class Bloco extends AddressType
{
    const CODE = 6;

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
        return 'Bloco';
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
