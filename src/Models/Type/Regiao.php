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

    public function getName(): string
    {
        return 'Região';
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
     * @psalm-return array{0: Rua::class, 1: self::class}
     */
    public function filhos(): array
    {
        return [
            Rua::class,
            Regiao::class,
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
