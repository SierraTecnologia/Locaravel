<?php

namespace Locaravel\Exceptions;

class GeolocationException extends \Exception
{
    public static function curlNotInstalled(): GeolocationException
    {
        return new self(
            'This method requires cURL (http://php.net/curl), it seems like the extension isn\'t installed.'
        );
    }

    public static function noAddressFoundForCoordinates($latitude, $longitude): GeolocationException
    {
        return new self(
            'No address found for coordinates.
             With latitude: "' . $latitude . '" and longitude "' . $longitude . '".'
        );
    }

    public static function noCoordinatesFoundforAddress(array $addressData): GeolocationException
    {
        return new self(
            'No coordinates found for address.
             With address: "' . implode(', ', $addressData) . '".'
        );
    }
}
