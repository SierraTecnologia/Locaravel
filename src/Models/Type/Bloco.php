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

    public function getName(): string
    {
        return 'Bloco';
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
