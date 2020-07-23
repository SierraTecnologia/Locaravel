<?php

namespace Locaravel\Managers;

use Locaravel\Models\Localizations as Location;
use Locaravel\ManagersManager;
use Locaravel\Entities\LocationEntity;
use Locaravel\ValueObjects\Coordinates;
use Locaravel\ValueObjects\Latitude;
use Locaravel\ValueObjects\Longitude;
use Illuminate\Database\ConnectionInterface as Database;

/**
 * Class ARLocationManager.
 *
 * @package Locaravel\Managers
 */
class ARLocationManager implements LocationManager
{
    /**
     * @var Database
     */
    private $database;

    /**
     * @var LocationValidator
     */
    private $validator;

    /**
     * ARLocationManager constructor.
     *
     * @param Database          $database
     * @param LocationValidator $validator
     */
    public function __construct(Database $database, LocationValidator $validator)
    {
        $this->database = $database;
        $this->validator = $validator;
    }

    /**
     * @inheritdoc
     */
    public function create(array $attributes): LocationEntity
    {
        $attributes = $this->validator->validateForCreate($attributes);

        $coordinates = new Coordinates(new Latitude($attributes['latitude']), new Longitude($attributes['longitude']));

        $location = (new Location)->fill(['coordinates' => $coordinates]);

        $location->save();

        return $location->toEntity();
    }
}
