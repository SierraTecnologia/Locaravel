<?php

namespace Locaravel\Services;

use GuzzleHttp\Client;
use Locaravel\Conversations\Location;

class MapsService
{
    public static function getAddressLocation(string $query, $return = Location::class, $isAddress = true): ?object
    {
        $token = config('services.google_maps.token');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$query}&key={$token}";
        if ($isAddress) {
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$query}&key={$token}";
        }

        $client = new Client();
        $response = $client->post($url);

        $response = json_decode($response->getBody());

        if (! $response->results || ! isset($response->results[0]->geometry->location)) {
            return null;
        }

        $location = $response->results[0]->geometry->location;

        return new $return($location->lat, $location->lng);
    }
    public static function getLocationAddress(string $query, $return = Location::class)
    {
        return self::getAddressLocation($query, $return, false);
    }

}
