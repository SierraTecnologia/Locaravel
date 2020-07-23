<?php

namespace Locaravel\Facades;

use Illuminate\Support\Facades\Facade;

class AddressServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AddressService';
    }
}
