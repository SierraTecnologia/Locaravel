<?php

namespace Locaravel\Entities;

use Locaravel\ValueObjects\Coordinates;
use Locaravel\ValueObjects\Latitude;
use Locaravel\ValueObjects\Longitude;

/**
 * Class AddressEntity.
 *
 * @package Core\Entities
 */
final class AddressEntity extends AbstractEntity
{
    /**
     * @var int|null
     */
    private $id;


    /**
     * @param  int $id
     * @return $this
     */
    private function setId(int $id): AddressEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param  LocationEntity|null $location
     * @return $this
     */
    private function setLocation(?LocationEntity $location): AddressEntity
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return LocationEntity|null
     */
    public function getLocation(): ?LocationEntity
    {
        return $this->location;
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return (string) $this->getCoordinates();
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'location' => $this->getLocation() ? $this->getLocation()->toArray() : null,
        ];
    }
}
