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
    const CODE = 3;
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
        return 'Condominio';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: QuantosPrediosExistem::class}
     */
    public function perguntas(): array
    {
        return [
            QuantosPrediosExistem::class,
        ];
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: Residencia::class}
     */
    public function filhos(): array
    {
        return [
            Residencia::class,
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
