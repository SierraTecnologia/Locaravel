<?php

namespace Locaravel\Conversations;

use BotMan\BotMan\Messages\Attachments\Location as BotManLocation;

class Location
{

    const EARTH_RADIUS = 6371;
    /**
     * @var float 
     */
    public $latitude;

    /**
     * @var float 
     */
    public $longitude;
}