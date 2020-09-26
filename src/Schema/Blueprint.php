<?php namespace Locaravel\Schema;

class Blueprint extends \Bosnadev\Database\Schema\Blueprint
{
    /**
     * Add a point column on the table
     *
     * @param $column
     *
     * @return \Illuminate\Database\Schema\ColumnDefinition
     */
    public function point($column, $srid = 'GEOGRAPHY', $srid_new = '4326')
    {
        return $this->addColumn('point', $column, compact('geomtype', 'srid'));
    }

    /**
     * Add a multipoint column on the table
     *
     * @param $column
     *
     * @return \Illuminate\Database\Schema\ColumnDefinition
     */
    public function multipoint($column, $geomtype = 'GEOGRAPHY', $srid = '4326')
    {
        return $this->addColumn('multipoint', $column, compact('geomtype', 'srid'));
    }

    /**
     * Add a polygon column on the table
     *
     * @param $column
     *
     * @return \Illuminate\Database\Schema\ColumnDefinition
     */
    public function polygon($column, $geomtype = 'GEOGRAPHY', $srid = '4326')
    {
        return $this->addColumn('polygon', $column, compact('geomtype', 'srid'));
    }

    /**
     * Add a multipolygon column on the table
     *
     * @param $column
     *
     * @return \Illuminate\Database\Schema\ColumnDefinition
     */
    public function multipolygon($column, $geomtype = 'GEOGRAPHY', $srid = '4326')
    {
        return $this->addColumn('multipolygon', $column, compact('geomtype', 'srid'));
    }

    /**
     * Add a linestring column on the table
     *
     * @param $column
     *
     * @return \Illuminate\Database\Schema\ColumnDefinition
     */
    public function linestring($column, $geomtype = 'GEOGRAPHY', $srid = '4326')
    {
        return $this->addColumn('linestring', $column, compact('geomtype', 'srid'));
    }

    /**
     * Add a multilinestring column on the table
     *
     * @param $column
     *
     * @return \Illuminate\Database\Schema\ColumnDefinition
     */
    public function multilinestring($column, $geomtype = 'GEOGRAPHY', $srid = '4326')
    {
        return $this->addColumn('multilinestring', $column, compact('geomtype', 'srid'));
    }

    /**
     * Add a geometry column on the table
     *
     * @param string $column
     *
     * @return \Illuminate\Database\Schema\ColumnDefinition
     */
    public function geometry($column, $geomtype = 'GEOGRAPHY', $srid = '4326')
    {
        return $this->addColumn('geometry', $column, compact('geomtype', 'srid'));
    }

    /**
     * Add a geometrycollection column on the table
     *
     * @param  $column
     * @param  null $srid
     * @param  int  $dimensions
     * @param  bool $typmod
     * @return \Illuminate\Support\Fluent
     */
    public function geometrycollection($column, $srid = null, $dimensions = 2, $typmod = true)
    {
        return $this->addCommand('geometrycollection', compact('column', 'srid', 'dimensions', 'typmod'));
    }

}
