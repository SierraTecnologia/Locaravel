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

    public static function createFromGoogleResult(\stdClass $result): Address
    {
        return new self(
            $result,
            $result->formatted_address ?? null
        );
    }

    public function getResult(): \stdClass
    {
        return $this->result;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Captura a coordenada de acordo com o endereço
     *
     * @return void
     */
    public function getCoordinates()
    {
        $street = 'Koningin Maria Hendrikaplein';
        $streetNumber = '1';
        $city = 'Gent';
        $zip = '1';
        $country = 'belgium';

        return Geolocation::getCoordinates(
            $street,
            $streetNumber,
            $city,
            $zip,
            $country
        );
    }
}
