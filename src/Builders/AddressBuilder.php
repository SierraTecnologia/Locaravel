<?php

namespace Locaravel\Builders;

use Locaravel\Contants\Tables;
use Locaravel\ValueObjects\Coordinates;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AddressBuilder.
 *
 * @package Locaravel\Builders
 */
class AddressBuilder extends Builder
{
    /**
     * @var string
     */
    private $locationsTable = Tables::TABLE_ADDRESSES;

}
