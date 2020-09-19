<?php

namespace Locaravel\Traits;

use Illuminate\Support\Facades\DB;

trait ModelHasAddress
{
    public static function bootModelHasAddress()
    {
        static::saving(
            function ($model) {
                if (isset($model->cep)) {
                    unset($model->cep);
                }
                // $model->slug = $model->generateSlug($model->title);
            }
        );
        static::creating(
            function ($model) {
                if (isset($model->cep)) {
                    unset($model->cep);
                }
                // $model->slug = $model->generateSlug($model->title);
            }
        );
    }

    // public function generateSlug($string)
    // {
    //     return strtolower(preg_replace(
    //         ['/[^\w\s]+/', '/\s+/'],
    //         ['', '-'],
    //         $string
    //     ));
    // }
    


    // public function getLocalizationAttribute()
    // {
    //     if (is_object($this->address) && is_object($this->address->localization)) {
    //         return $this->address->localization;
    //     }
    //     if (!is_object($this->address)) {
    //         // dd($this);
    //     }
    //     // dd($this->address);
    // }
    public function getLatitudeAttribute()
    {
        return $this->localization->latitude;
    }
    public function getLongitudeAttribute()
    {
        return $this->localization->longitude;
    }

    /**
     * Get the post's addresse.
     */
    public function addresse()
    {
        return $this->morphOne('Locaravel\Models\Address', 'addresseable');
    }



    /**
     * Get the post's localization.
     */
    public function localization()
    {
        return $this->morphOne('Locaravel\Models\Localization', 'localizationable');
    }
}
