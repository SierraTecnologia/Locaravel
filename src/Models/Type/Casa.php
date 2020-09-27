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
     *
     * @var false
     */
    public $timestamps = false;

    /**
     * @inheritdoc
     *
     * @var string[]
     *
     * @psalm-var array{0: string}
     */
    protected $fillable = [
        'value',
    ];

    public function getName(): string
    {
        return 'Casa';
    }



}
