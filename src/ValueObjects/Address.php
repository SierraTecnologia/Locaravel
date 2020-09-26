<?php

namespace Locaravel\ValueObjects;

class Address
{
    /**
     * @var \stdClass 
     */
    private $result;

    /**
     * @var null|string 
     */
    private $label;

    private function __construct(
        \stdClass $result,
        ?string $label
    ) {
        $this->addressComponents = $result;
        $this->label = $label;
    }
}
