<?php

namespace Locaravel\Models\Type;

use Locaravel\Questions\Perguntas\QuantosPrediosExistem;
use Locaravel\Questions\ResponseTypes\Inteiro;
use Locaravel\Models\Model;

/**
 * Class Predio.
 *
 * @property int id
 * @property string value
 * @property Collection posts
 * @package  Locaravel\Models
 */
class Predio extends AddressType
{
    const CODE = 4;

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
        return 'Predio';
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
     * @return (\Closure|string)[][]
     *
     * @psalm-return array{blocos: array{name: 'Número de Blocos', result: \Closure(mixed, mixed):void}}
     */
    public static function extraImutableAtributes(): array
    {
        return [
            // 'andares'
            // 'apart'
            'blocos' => [
                'name' => 'Número de Blocos',
                // 'type' => Integer::class,
                // 'children' => Bloco::extraImutableAtributes(),
                'result' => function ($result, $parent) {
                    foreach ($result as $indice=>$valor) {
                        $data = [
                            'content' => (string) $indice,
                            'description' => 'Bloco '.$indice,
                            'address_id' => $parent->id,
                            'extra_atributes' => $valor
                        ];
                        $bloco = Bloco::registerOrReturnAddress($data);
                    }
                }
            ]
        ];
    }

    public function extraAtributes(): void
    {
        
    }

}
