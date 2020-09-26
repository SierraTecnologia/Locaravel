<?php namespace Locaravel\Geometries;

use GeoIO\WKB\Parser\Parser;
use Locaravel\Exceptions\UnknownWKTTypeException;

abstract class Geometry implements GeometryInterface, \JsonSerializable
{


    /**
     * @return false|string
     */
    public static function getWKTArgument($value)
    {
        $left = strpos($value, '(');
        $right = strrpos($value, ')');

        return substr($value, $left + 1, $right - $left - 1);
    }

    /**
     * @return GeometryCollection::class|LineString::class|MultiLineString::class|MultiPoint::class|MultiPolygon::class|Point::class|Polygon::class
     */
    public static function getWKTClass(string $value)
    {
        $left = strpos($value, '(');
        $type = trim(substr($value, 0, $left));

        switch (strtoupper($type)) {
        case 'POINT':
            return Point::class;
        case 'LINESTRING':
            return LineString::class;
        case 'POLYGON':
            return Polygon::class;
        case 'MULTIPOINT':
            return MultiPoint::class;
        case 'MULTILINESTRING':
            return MultiLineString::class;
        case 'MULTIPOLYGON':
            return MultiPolygon::class;
        case 'GEOMETRYCOLLECTION':
            return GeometryCollection::class;
        default:
            throw new UnknownWKTTypeException('Type was ' . $type);
        }
    }

    public static function fromWKT($wkt)
    {
        $wktArgument = static::getWKTArgument($wkt);

        return static::fromString($wktArgument);
    }
}
