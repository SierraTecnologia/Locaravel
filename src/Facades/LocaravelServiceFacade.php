<?php

namespace Locaravel\Facades;

use Illuminate\Support\Facades\Facade;

class LocaravelServiceFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'LocaravelService';
    }

} 