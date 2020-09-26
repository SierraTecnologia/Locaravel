<?php

namespace Locaravel\Models\Type;

use Locaravel\Questions\Perguntas\QuantosPrediosExistem;
use Locaravel\Questions\ResponseTypes\Inteiro;
use Locaravel\Models\Model;

/**
 * Class Apartamento.
 *
 * @property int id
 * @property string value
 * @property Collection posts
 * @package  Locaravel\Models
 */
class Apartamento extends AddressType
{
    const CODE = 7;

    /**
     * @inheritdoc
     *
     * @var false
     */
    public bool $timestamps = false;

    /**
     * @inheritdoc
     *
     * @var string[]
     *
     * @psalm-var array{0: string}
     */
    protected array $fillable = [
        'value',
    ];

    public function getName(): string
    {
        return 'Apartamento';
    }



}
