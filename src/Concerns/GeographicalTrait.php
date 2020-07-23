<?php

namespace Locaravel\Concerns;

use Log;
use Illuminate\Database\Eloquent\Builder;
use Locaravel\Builders\LocationBuilder;
use Locaravel\Contants\Tables;
use Locaravel\Entities\LocationEntity;
use Locaravel\ValueObjects\Coordinates;
use Locaravel\ValueObjects\Latitude;
use Locaravel\ValueObjects\Longitude;
use Locaravel\Models\Model;
use Illuminate\Support\Str;

trait GeographicalTrait
{
    /**
     * @param  Builder $query
     * @param  float   $latitude  Latitude
     * @param  float   $longitude Longitude
     * @return Builder
     */
    public function scopeDistance($query, $latitude, $longitude)
    {
        $latName = $this->getQualifiedLatitudeColumn();
        $lonName = $this->getQualifiedLongitudeColumn();
        $query->select($this->getTable() . '.*');
        $sql = "((ACOS(SIN(? * PI() / 180) * SIN(" . $latName . " * PI() / 180) + COS(? * PI() / 180) * COS(" .
            $latName . " * PI() / 180) * COS((? - " . $lonName . ") * PI() / 180)) * 180 / PI()) * 60 * ?) as distance";

        $kilometers = false;
        if (property_exists(static::class, 'kilometers')) {
            $kilometers = static::$kilometers;
        }

        if ($kilometers) {
            $query->selectRaw($sql, [$latitude, $latitude, $longitude, 1.1515 * 1.609344]);
        } else {
            // miles
            $query->selectRaw($sql, [$latitude, $latitude, $longitude, 1.1515]);
        }

        //echo $query->toSql();
        //var_export($query->getBindings());
        return $query;
    }

    public function scopeGeofence($query, $latitude, $longitude, $inner_radius, $outer_radius)
    {
        $query = $this->scopeDistance($query, $latitude, $longitude);
        return $query->havingRaw('distance BETWEEN ? AND ?', [$inner_radius, $outer_radius]);
    }

    protected function getQualifiedLatitudeColumn()
    {
        return $this->getTable() . '.' . $this->getLatitudeColumn();
    }

    protected function getQualifiedLongitudeColumn()
    {
        return $this->getTable() . '.' . $this->getLongitudeColumn();
    }

    public function getLatitudeColumn()
    {
        return defined('static::LATITUDE') ? static::LATITUDE : 'latitude';
    }

    public function getLongitudeColumn()
    {
        return defined('static::LONGITUDE') ? static::LONGITUDE : 'longitude';
    }

    /**************************************************************************
     *                  Do Location
     *************************************************************************/

    /**
     * @param  Coordinates $coordinates
     * @return $this
     */
    public function setCoordinatesAttribute(Coordinates $coordinates)
    {
        $expression = "ST_GeomFromText('POINT({$coordinates})')";

        $this->attributes['coordinates'] = $this->getConnection()->raw($expression);

        return $this;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinatesAttribute(): Coordinates
    {
        $raw = Str::before(Str::after($this->attributes['coordinates'], 'POINT('), ')');

        [$latitude, $longitude] = explode(' ', $raw);

        return new Coordinates(new Latitude($latitude), new Longitude($longitude));
    }

    public function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2)
    {
        // Calculate the distance in degrees
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
     
        // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
        switch($unit) {
        case 'km':
            $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
            break;
        case 'mi':
            $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
            break;
        case 'nmi':
            $distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
        }
        return round($distance, $decimals);
    }
}
