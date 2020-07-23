<?php

namespace Locaravel\Services;

use Locaravel\Models\Address;
use Locaravel\Models\Type\AddressType;

class AddressService
{
    
    
    public function __construct()
    {
        
    }

    /**
     * Users as Select options array
     *
     * @return Array
     */
    public function typesForCobertura()
    {
        return AddressType::all();
    }

    public function typesForCoberturaForSelect()
    {
        return AddressType::pluck('name', 'id')->toArray();
    }
}
