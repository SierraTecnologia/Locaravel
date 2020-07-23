<?php

namespace Locaravel\Contracts;

use Locaravel\Entities\AddressEntity;

/**
 * Interface AddressManager.
 *
 * @package Core\Contracts
 */
interface AddressManager
{
    /**
     * Create a Address.
     *
     * @param  array $attributes
     * @return AddressEntity
     */
    public function create(array $attributes): AddressEntity;
}
