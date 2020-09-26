<?php namespace Locaravel\Geometries;

interface GeometryInterface
{
    public function toWKT();

    public function __toString();

    public static function fromString($wktArgument);
}
