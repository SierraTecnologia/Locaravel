<?php

namespace Locaravel\Models;

use Illuminate\Support\Str;
use Locaravel\Builders\LocationBuilder;
use Locaravel\Concerns\GeographicalTrait;
use Locaravel\Contants\Tables;
use Locaravel\Entities\LocationEntity;
use Locaravel\Models\Model;
use Locaravel\ValueObjects\Coordinates;
use Locaravel\ValueObjects\Latitude;
use Locaravel\ValueObjects\Longitude;

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
    public static $kilometers = true;

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

    /**
     * Get the owning localizationable model.
     */
    public function localizationable()
    {
        return $this->morphTo();
    }
 
}
