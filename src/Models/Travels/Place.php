<?php

namespace Locaravel\Models\Travels;

// use Locaravel\Models\Model;
use Pedreiro\Models\Base as Model;

class Place extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        // 'code',
    ];

    public $formFields = [
        [
            'name' => 'name',
            'label' => 'name',
            'type' => 'text'
        ],
        // [
        //     'name' => 'agencia',
        //     'label' => 'agencia',
        //     'type' => 'text'
        // ],
        [
            'name' => 'description',
            'label' => 'description',
            'type' => 'text'
        ],
        // [
        //     'name' => 'slug',
        //     'label' => 'slug',
        //     'type' => 'text'
        // ],
        // [
        //     'name' => 'status',
        //     'label' => 'Status',
        //     'type' => 'checkbox'
        // ],
        // [
        //     'name' => 'status',
        //     'label' => 'Enter your content here',
        //     'type' => 'textarea'
        // ],
        // ['name' => 'publish_on', 'label' => 'Publish Date', 'type' => 'date'],
        // ['name' => 'category_id', 'label' => 'Category', 'type' => 'select', 'relationship' => 'category'],
        // ['name' => 'tags', 'label' => 'Tags', 'type' => 'select_multiple', 'relationship' => 'tags'],
    ];

    public $indexFields = [
        'name',
        'description',
        // 'slug',
        // 'status'
    ];

    /**
     * Get the type that owns the phone.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PlaceType::class);
    }

    // /**
    //  * Get the rooms
    //  *
    //  * @return array
    //  */
    // public function rooms()
    // {
    //     return $this->aparts();
    // }
    // /**
    //  * Get the aparts
    //  *
    //  * @return array
    //  */
    // public function aparts()
    // {
    //     return $this->hasMany(Apart::class); //, 'hotel_id');
    // }
}
