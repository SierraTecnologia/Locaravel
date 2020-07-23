<?php

use Locaravel\Geometries\Point;
use Locaravel\Geometries\MultiPoint;
use Locaravel\Geometries\LineString;
use Locaravel\Geometries\MultiLineString;
use Locaravel\Geometries\Polygon;
use Locaravel\Geometries\MultiPolygon;
use Locaravel\Geometries\GeometryCollection;

class UnderLocaleTest extends BaseTestCase
{
    
    public static function setUpBeforeClass()
    {
        setlocale(LC_NUMERIC, 'fr_FR.utf-8');
    }
    
    public static function tearDownAfterClass()
    {
        setlocale(LC_NUMERIC, null);
    }
    
    public function setUp()
    {
        if(localeconv()['decimal_point'] == '.') {
            $this->markTestSkipped('The locale is not available for testing float output formatting');
        }
    }
    
    public function testPointToWKT()
    {
        $point = new Point(1.5, 2.5);
        $this->assertEquals('POINT(2.5 1.5)', $point->toWKT());
    }
    
    public function testMultiPointToWKT()
    {
        $multipoint = new MultiPoint([new Point(1.5, 1.5), new Point(1.5, 2.5), new Point(2.5, 2.5)]);

        $this->assertEquals('MULTIPOINT((1.5 1.5),(2.5 1.5),(2.5 2.5))', $multipoint->toWKT());
    }
    
    public function testLineStringToWKT()
    {
        $linestring = new LineString([new Point(1.5, 1.5), new Point(2.5, 2.5), new Point(3.5, 3.5)]);

        $this->assertEquals('LINESTRING(1.5 1.5,2.5 2.5,3.5 3.5)', $linestring->toWKT());
    }

    public function testMultiLineStringToWKT()
    {
        $collection = new LineString(
            [
                new Point(1.5, 1.5),
                new Point(1.5, 2.5),
                new Point(2.5, 2.5),
                new Point(2.5, 1.5),
                new Point(1.5, 1.5)
            ]
        );

        $multilinestring = new MultiLineString([$collection]);

        $this->assertSame('MULTILINESTRING((1.5 1.5,2.5 1.5,2.5 2.5,1.5 2.5,1.5 1.5))', $multilinestring->toWKT());
    }
    
    public function testPolygonToWKT()
    {
        $collection = new LineString(
            [
                new Point(1.5, 1.5),
                new Point(1.5, 2.5),
                new Point(2.5, 2.5),
                new Point(2.5, 1.5),
                new Point(1.5, 1.5)
            ]
        );

        $polygon = new Polygon([$collection]);
        
        $this->assertEquals('POLYGON((1.5 1.5,2.5 1.5,2.5 2.5,1.5 2.5,1.5 1.5))', $polygon->toWKT());
    }
    
    public function testMultiPolygonToWKT()
    {
        $collection1 = new LineString(
            [
                new Point(1.5, 1.5),
                new Point(1.5, 2.5),
                new Point(2.5, 2.5),
                new Point(2.5, 1.5),
                new Point(1.5, 1.5)
            ]
        );

        $collection2 = new LineString(
            [
                new Point(10.5, 10.5),
                new Point(10.5, 20.5),
                new Point(20.5, 20.5),
                new Point(20.5, 10.5),
                new Point(10.5, 10.5)
            ]
        );

        $polygon1 = new Polygon([$collection1, $collection2]);

        $collection3 = new LineString(
            [
                new Point(100.5, 100.5),
                new Point(100.5, 200.5),
                new Point(200.5, 200.5),
                new Point(200.5, 100.5),
                new Point(100.5, 100.5)
            ]
        );

        $polygon2 = new Polygon([$collection3]);

        $multiPolygon = new MultiPolygon([$polygon1, $polygon2]);
        
        $this->assertEquals(
            'MULTIPOLYGON(((1.5 1.5,2.5 1.5,2.5 2.5,1.5 2.5,1.5 1.5),(10.5 10.5,20.5 10.5,20.5 20.5,10.5 20.5,10.5 10.5)),((100.5 100.5,200.5 100.5,200.5 200.5,100.5 200.5,100.5 100.5)))',
            $multiPolygon->toWKT()
        );
    }
    
    public function testGeometryCollectionToWKT()
    {
        $collection = new LineString(
            [
                new Point(1.5, 1.5),
                new Point(1.5, 2.5),
                new Point(2.5, 2.5),
                new Point(2.5, 1.5),
                new Point(1.5, 1.5)
            ]
        );

        $point = new Point(100.5, 200.5);

        $geo_collection = new GeometryCollection([$collection, $point]);

        $this->assertEquals(
            'GEOMETRYCOLLECTION(LINESTRING(1.5 1.5,2.5 1.5,2.5 2.5,1.5 2.5,1.5 1.5),POINT(200.5 100.5))',
            $geo_collection->toWKT()
        );
    }

}
