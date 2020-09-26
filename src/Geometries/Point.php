<?php namespace Locaravel\Geometries;

use GeoJson\GeoJson;

class Point extends Geometry
{
    protected float $lat;
    protected float $lng;

    public function __construct($lat, $lng)
    {
        $this->lat = (float)$lat;
        $this->lng = (float)$lng;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function getLng()
    {
        return $this->lng;
    }

    public function toPair(): string
    {
        return self::stringifyFloat($this->getLng()) . ' ' . self::stringifyFloat($this->getLat());
    }
    
    private static function stringifyFloat($float): string
    {
        // normalized output among locales
        return rtrim(rtrim(sprintf('%F', $float), '0'), '.');
    }
    
    public static function fromPair(string $pair): self
    {
        $pair = preg_replace('/^[a-zA-Z\(\)]+/', '', trim($pair));
        list($lng, $lat) = explode(' ', trim($pair));

        return new static((float)$lat, (float)$lng);
    }

    /**
     * @return string
     */
    public function toWKT()
    {
        return sprintf('POINT(%s)', (string)$this);
    }

    public static function fromString($wktArgument)
    {
        return static::fromPair($wktArgument);
    }

    public function __toString()
    {
        return $this->toPair();
    }

    /**
     * Convert to GeoJson Point that is jsonable to GeoJSON
     *
     * @return \GeoJson\Geometry\Point
     */
    public function jsonSerialize()
    {
        return new \GeoJson\Geometry\Point([$this->getLng(), $this->getLat()]);
    }
}
