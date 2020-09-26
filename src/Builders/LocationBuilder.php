<?php

namespace Locaravel\Builders;

use Locaravel\Contants\Tables;
use Locaravel\ValueObjects\Coordinates;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LocationBuilder.
 *
 * @package Locaravel\Builders
 */
class LocationBuilder extends Builder
{
    /**
     * @var string
     */
    private $locationsTable = Tables::TABLE_LOCALIZATIONS;

    /**
     * Note: Laravel does not support spatial types.
     * See: https://dev.mysql.com/doc/refman/5.7/en/spatial-type-overview.html
     *
     * @return $this
     */
    public function defaultSelect()
    {
        $coordinates = "ST_AsText({$this->locationsTable}.coordinates) AS coordinates";

        return $this->addSelect("{$this->locationsTable}.*", $this->getConnection()->raw($coordinates));
    }
}
