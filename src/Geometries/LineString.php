<?php namespace Locaravel\Geometries;

class LineString extends PointCollection implements GeometryInterface
{
    /**
     * @return string
     */
    public function toWKT()
    {
        return sprintf('LINESTRING(%s)', $this->toPairList());
    }

    /**
     * @return static
     */
    public static function fromWKT($wkt)
    {
        $wktArgument = Geometry::getWKTArgument($wkt);

        return static::fromString($wktArgument);
    }

    /**
     * @return static
     *
     * @param false|string $wktArgument
     */
    public static function fromString($wktArgument)
    {
        $pairs = explode(',', trim($wktArgument));
        $points = array_map(
            function ($pair) {
                return Point::fromPair($pair);
            }, $pairs
        );

        return new static($points);
    }

    public function __toString()
    {
        return $this->toPairList();
    }

    /**
     * Convert to GeoJson LineString that is jsonable to GeoJSON
     *
     * @return \GeoJson\Geometry\LineString
     */
    public function jsonSerialize()
    {
        $points = [];
        foreach ($this->points as $point) {
            $points[] = $point->jsonSerialize();
        }

        return new \GeoJson\Geometry\LineString($points);
    }
}
