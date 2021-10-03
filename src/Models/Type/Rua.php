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

    public function getName(): string
    {
        return 'Rua';
    }

    /**
     * @return array
     *
     * @psalm-return array<empty, empty>
     */
    public function perguntas(): array
    {
        return [

        ];
    }

    public static function returnOrRegisterStreet(): void
    {

    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: Casa::class, 1: Condominio::class}
     */
    public function filhos(): array
    {
        return [
            Casa::class,
            Condominio::class,
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
