<?php

namespace Locaravel\Services;

use GuzzleHttp\Client;
use Locaravel\Conversations\Location;
use Locaravel\Models\Address;
use Locaravel\Models\Type\AddressType;

class AddressService
{
    
    
    public function __construct()
    {
        
    }

    /**
     * Users as Select options array
     *
     * @return Array
     */
    public function typesForCobertura()
    {
        return AddressType::all();
    }

    public function typesForCoberturaForSelect()
    {
        return AddressType::pluck('name', 'id')->toArray();
    }
    
    public function getAddressLocation(string $query)
    {
        $token = config('services.google_maps.token');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$query}&key={$token}";

        $client = new Client();
        $response = $client->post($url);

        $response = json_decode($response->getBody());

        if (! $response->results || ! isset($response->results[0]->geometry->location)) {
            return null;
        }

        $location = $response->results[0]->geometry->location;

        // Conversation
        return new Location($location->lat, $location->lng);
    }
}
