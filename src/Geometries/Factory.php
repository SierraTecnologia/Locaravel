<?php namespace Locaravel\Geometries;

class Factory implements \GeoIO\Factory
{
    /**
     * @return Point
     */
    public function createPoint( $dimension, array $coordinates, $srid = null )
    {
        return new Point($coordinates['y'], $coordinates['x']);
    }

    /**
     * @return LineString
     */
    public function createLineString( $dimension, array $points, $srid = null )
    {
        return new LineString($points);
    }

    /**
     * @return LineString
     */
    public function createLinearRing( $dimension, array $points, $srid = null )
    {
        return new LineString($points);
    }

    /**
     * @return Polygon
     */
    public function createPolygon( $dimension, array $lineStrings, $srid = null )
    {
        return new Polygon($lineStrings);
    }

    /**
     * @return MultiPoint
     */
    public function createMultiPoint( $dimension, array $points, $srid = null )
    {
        return new MultiPoint($points);
    }

    /**
     * @return MultiLineString
     */
    public function createMultiLineString( $dimension, array $lineStrings, $srid = null )
    {
        return new MultiLineString($lineStrings);
    }

    /**
     * @return MultiPolygon
     */
    public function createMultiPolygon( $dimension, array $polygons, $srid = null )
    {
        return new MultiPolygon($polygons);
    }

    /**
     * @return GeometryCollection
     */
    public function createGeometryCollection( $dimension, array $geometries, $srid = null )
    {
        return new GeometryCollection($geometries);
    }

}
