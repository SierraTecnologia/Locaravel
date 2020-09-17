<?php

namespace Locaravel\Traits;

use Illuminate\Support\Facades\DB;

trait ModelHasAddress
{
    public function getLocalizationAttribute()
    {
        if (!is_object($this->address)) {
            dd($this);
        }
        if (is_object($this->address->localization)) {
            return $this->address->localization;
        }
        dd($this->address);
    }
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
}
