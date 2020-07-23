<?php

namespace Locaravel\Models;

use Locaravel\Builders\LocationBuilder;
use Locaravel\Contants\Tables;
use Locaravel\Entities\LocationEntity;
use Locaravel\ValueObjects\Coordinates;
use Locaravel\ValueObjects\Latitude;
use Locaravel\ValueObjects\Longitude;
use Locaravel\Models\Model;
use Illuminate\Support\Str;
use Locaravel\Concerns\GeographicalTrait;

/**
 * Class Location.
 *
 * Note: Laravel does not support spatial types.
 * See: https://dev.mysql.com/doc/refman/5.7/en/spatial-type-overview.html
 *
 * @property int id
 * @property Coordinates coordinates
 * @package  Locaravel\Models
 */
class Localization extends Model
{
    use GeographicalTrait;
    
    public static $classeBuilder = LocationBuilder::class;

    /**
     * @inheritdoc
     */
    public $timestamps = false;

    /**
     * @inheritdoc
     */
    protected $table = Tables::TABLE_LOCALIZATIONS;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'coordinates',
        // 'name',
        // 'code',
    ];


    // public static function rules(){
    //     return array('code' => 'required');
    // }

    /**
     * @inheritdoc
     */
    public function newEloquentBuilder($query): LocationBuilder
    {
        return (new LocationBuilder($query))->defaultSelect();
    }

    /**
     * @inheritdoc
     */
    public function newQuery(): LocationBuilder
    {
        return parent::newQuery();
    }



    /**
     * @return LocationEntity
     */
    public function toEntity(): LocationEntity
    {
        return new LocationEntity(
            [
            'id' => $this->id,
            'coordinates' => $this->coordinates->toArray(),
            ]
        );
    }
}
