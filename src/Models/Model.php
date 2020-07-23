<?php

namespace Locaravel\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    public function hasAttribute($attr)                                                                                                                                                          
    {                                                                                                                    
        return array_key_exists($attr, $this->attributes);
    }

    protected static function boot()
    {
        parent::boot();
    }
}