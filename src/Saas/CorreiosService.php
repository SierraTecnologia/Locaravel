<?php

namespace Locaravel\Saas;

use Log;
use Validate\Cep;

class CorreiosService extends Service
{
    public function __construct()
    {
        $this->url = 'https://viacep.com.br/ws';
        $this->companyToken = false;
    }

    public function validateCep($cep)
    {
        $cep = Cep::toDatabase($cep);
        if (!$cep = $this->get($cep.'/json')) {
            return [
                "erro" => true
            ];
        }
        return $cep;
    }
}
