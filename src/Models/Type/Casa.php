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
    const CODE = 5;

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

    public function getName(): string
    {
        return 'Casa';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: QuantasPessoasMoramAqui::class}
     */
    public function perguntas(): array
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

    /**
     * @return array
     *
     * @psalm-return array<empty, empty>
     */
    public static function extraImutableAtributes(): array
    {
        return [
            
        ];
    }

    public function extraAtributes(): void
    {
        
    }


}
