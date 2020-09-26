<?php

namespace Locaravel\Facades;

use Illuminate\Support\Facades\Facade;

class AddressServiceFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'AddressService';
    }
}
