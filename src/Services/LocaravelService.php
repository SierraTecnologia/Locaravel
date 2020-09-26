<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace Locaravel\Services;

/**
 *
 */
class LocaravelService
{
    protected $config;

    protected $modelServices = false;

    public function __construct($config = false)
    {
        // if (!$this->config = $config) {
        //     $this->config = \Illuminate\Support\Facades\Config::get('sitec-facilitador.models');
        // }
    }

    public function getModelServices()
    {
        if (!$this->modelServices) {
            $this->modelServices = $this->config->map(
                function ($value) {
                    return new ModelService($value, false);
                }
            );
        }

        return $this->modelServices;
    }
}
