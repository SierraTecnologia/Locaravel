<?php namespace Locaravel\Eloquent;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Arr;
use Locaravel\Exceptions\PostgisFieldsNotDefinedException;
use Locaravel\Exceptions\PostgisTypesMalformedException;
use Locaravel\Exceptions\UnsupportedGeomtypeException;
use Locaravel\Geometries\Geometry;
use Locaravel\Geometries\GeometryInterface;
use Locaravel\Schema\Grammars\PostgisGrammar;

trait PostgisTrait
{
    public $geometries = [];
    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Locaravel\Eloquent\Builder
     */
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    protected function performInsert(EloquentBuilder $query, array $options = [])
    {
        foreach ($this->attributes as $key => $value) {
            if ($value instanceof GeometryInterface) {
                $this->geometries[$key] = $value; //Preserve the geometry objects prior to the insert
                $this->attributes[$key] = $this->getPostgisValue($key, $value);
            }
        }

        $insert = parent::performInsert($query, $options);

        foreach($this->geometries as $key => $value){
            $this->attributes[$key] = $value; //Retrieve the geometry objects so they can be used in the model
        }

        return $insert; //Return the result of the parent insert
    }

    public function getPostgisValue($key, $value)
    {
        if (! $value instanceof GeometryCollection) {
            $attrs = $this->getPostgisType($key);
            switch (strtoupper($attrs['geomtype'])) {
            case 'GEOMETRY':
                return $this->getConnection()->raw(sprintf("public.ST_GeomFromText('%s', '%d')", $value->toWKT(), $attrs['srid']));
                    break;
            case 'GEOGRAPHY':
            default:
                return $this->getConnection()->raw(sprintf("public.ST_GeogFromText('%s')", $value->toWKT()));
                    break;
            }
        }

        return $this->getConnection()->raw(sprintf("public.ST_GeomFromText('%s', 4326)", $value->toWKT()));
    }

    public function setRawAttributes(array $attributes, $sync = false)
    {
        $pgfields = $this->getPostgisFields();

        foreach ($attributes as $attribute => &$value) {
            if (in_array($attribute, $pgfields) && is_string($value) && strlen($value) >= 15) {
                $value = Geometry::fromWKB($value);
            }
        }

        return parent::setRawAttributes($attributes, $sync);
    }

    public function getPostgisType($key)
    {
        $default = [
            'geomtype' => 'geography',
            'srid' => 4326
        ];

        if (property_exists($this, 'postgisTypes')) {
            if (Arr::isAssoc($this->postgisTypes)) {
                if(!array_key_exists($key, $this->postgisTypes)) {
                    return $default;
                }
                $column = $this->postgisTypes[$key];
                if (isset($column['geomtype']) && in_array(strtoupper($column['geomtype']), PostgisGrammar::$allowed_geom_types)) {
                    return $column;
                } else {
                    throw new UnsupportedGeomtypeException('Unsupported GeometryType in $postgisTypes for key ' . $key . ' in ' . __CLASS__);
                }
            } else {
                throw new PostgisTypesMalformedException('$postgisTypes in ' . __CLASS__ . ' has to be an assoc array');
            }
        }

        // Return default geography if postgisTypes does not exist (for backward compatibility)
        return $default;
    }

    public function getPostgisFields()
    {
        if (property_exists($this, 'postgisFields')) {
            return Arr::isAssoc($this->postgisFields) ? //Is the array associative?
                array_keys($this->postgisFields) : //Returns just the keys to preserve compatibility with previous versions
                $this->postgisFields; //Returns the non-associative array that doesn't define the geometry type.
        } else {
            throw new PostgisFieldsNotDefinedException(__CLASS__ . ' has to define $postgisFields');
        }

    }
}
