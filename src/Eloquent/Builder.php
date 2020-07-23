<?php namespace Locaravel\Eloquent;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Locaravel\Geometries\GeometryInterface;

class Builder extends EloquentBuilder
{
    public function update(array $values)
    {
        foreach ($values as $key => &$value) {
            if ($value instanceof GeometryInterface) {
                $value = $this->getModel()->getPostgisValue($key, $value);
            }
        }

        return parent::update($values);
    }
}
