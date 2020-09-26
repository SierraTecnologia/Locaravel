<?php

namespace Locaravel\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Locaravel\Builders\LocationBuilder;
use Locaravel\Contants\Tables;
use Locaravel\Entities\LocationEntity;
use Locaravel\Models\Model;
use Locaravel\ValueObjects\Coordinates;
use Locaravel\ValueObjects\Latitude;
use Locaravel\ValueObjects\Longitude;
use Log;

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

    public function scopeGeofence($query, $latitude, $longitude, $inner_radius, $outer_radius): \Illuminate\Database\Eloquent\Builder
    {
        $query = $this->scopeDistance($query, $latitude, $longitude);
        return $query->havingRaw('distance BETWEEN ? AND ?', [$inner_radius, $outer_radius]);
    }

    protected function getQualifiedLatitudeColumn(): string
    {
        return $this->getTable() . '.' . $this->getLatitudeColumn();
    }

    protected function getQualifiedLongitudeColumn(): string
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
}
