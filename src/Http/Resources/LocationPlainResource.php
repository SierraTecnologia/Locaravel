<?php

namespace Locaravel\Http\Resources;

use Locaravel\Entities\LocationEntity;
use Illuminate\Http\Resources\Json\JsonResource as Resource;
use function SiUtils\Helper\html_purify;
use function SiUtils\Helper\to_float;

/**
 * Class LocationPlainResource.
 *
 * @package Locaravel\Http\Resources
 */
class LocationPlainResource extends Resource
{
    /**
     * @var LocationEntity
     */
    public $resource;

    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return [
            'latitude' => to_float(html_purify($this->resource->getCoordinates()->getLatitude())),
            'longitude' => to_float(html_purify($this->resource->getCoordinates()->getLongitude())),
        ];
    }
}
