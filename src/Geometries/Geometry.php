<?php namespace Locaravel\Geometries;

use GeoIO\WKB\Parser\Parser;
use Locaravel\Exceptions\UnknownWKTTypeException;

abstract class Geometry implements GeometryInterface, \JsonSerializable
{
    protected static $wkb_types = [
        1 => Point::class,
        2 => LineString::class,
        3 => Polygon::class,
        4 => MultiPoint::class,
        5 => MultiLineString::class,
        6 => MultiPolygon::class,
        7 => GeometryCollection::class
    ];

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
     * @return string
     */
    public static function getWKTClass($value): string
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

    public static function fromWKB($wkb)
    {
        $parser = new Parser(new Factory());

        return $parser->parse($wkb);
    }

    public static function fromWKT($wkt)
    {
        $wktArgument = static::getWKTArgument($wkt);

        return static::fromString($wktArgument);
    }
}
