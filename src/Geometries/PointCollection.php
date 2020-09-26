<?php namespace Locaravel\Geometries;

use ArrayAccess;
use ArrayIterator;
use Countable;
use Illuminate\Contracts\Support\Arrayable;
use InvalidArgumentException;
use IteratorAggregate;
use JsonSerializable;

abstract class PointCollection implements IteratorAggregate, Arrayable, ArrayAccess, Countable, JsonSerializable
{
    /**
     * @var Point[]
     */
    protected $points;

    /**
     * @param Point[] $points
     */
    public function __construct(array $points)
    {
        if (count($points) < 2) {
            throw new InvalidArgumentException('$points must contain at least two entries');
        }

        $validated = array_filter(
            $points, function ($value) {
                return $value instanceof Point;
            }
        );

        if (count($points) !== count($validated)) {
            throw new InvalidArgumentException('$points must be an array of Points');
        }
        $this->points = $points;
    }

    /**
     * @return Point[]
     *
     * @psalm-return array<array-key, Point>
     */
    public function toArray()
    {
        return $this->points;
    }

    /**
     * @return ArrayIterator
     *
     * @psalm-return ArrayIterator<array-key, Point>
     */
    public function getIterator()
    {
        return new ArrayIterator($this->points);
    }

    public function appendPoint(Point $point): void
    {
        $this->points[] = $point;
    }

    public function offsetExists($offset)
    {
        return isset($this->points[$offset]);
    }

    /**
     * @param  mixed $offset
     * @return null|Point
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->points[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if (!($value instanceof Point)) {
            throw new InvalidArgumentException('$value must be an instance of Point');
        }

        if (is_null($offset)) {
            $this->appendPoint($value);
        } else {
            $this->points[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->points[$offset]);
    }

    public function toPairList(): string
    {
        return implode(
            ',', array_map(
                function (Point $point) {
                    return $point->toPair();
                }, $this->points
            )
        );
    }
}
