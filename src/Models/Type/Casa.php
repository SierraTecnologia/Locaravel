<?php

namespace Locaravel\Models\Type;

use Locaravel\Questions\Perguntas\QuantosPrediosExistem;
use Locaravel\Questions\ResponseTypes\Inteiro;
use Locaravel\Models\Model;

/**
 * Class Casa.
 *
 * @property int id
 * @property string value
 * @property Collection posts
 * @package  Locaravel\Models
 */
class Casa extends AddressType
{
    public static $DEFAULT_ID = 5;

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
        return 'Casa';
    }

    public function perguntas()
    {
        return [
            QuantasPessoasMoramAqui::class,
        ];
    }

    /**
     * Gera uma Nova Notificação para o Alvo
     *
     * @param  [type] $target
     * @param  [type] $typeEmergency
     * @param  array  $data
     * @return void
     */
    public static function generate($target, $typeEmergency, $data = [])
    {
        // @todo
        // self::create([

        // ]);
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
