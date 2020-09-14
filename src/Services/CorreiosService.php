<?php

namespace Locaravel\Services;

use App\Models\User;
use App\Sitec\Filter;
use Illuminate\Database\Eloquent\Model;
use Log;

class CorreiosService extends Service
{
    public function __construct()
    {
        $this->url = 'https://viacep.com.br/ws';
        $this->companyToken = false;
    }

    public function validateCep($cep)
    {
        $cep = Filter::cep($cep);
        if (!$cep = $this->get($cep.'/json')) {
            return [
                "erro" => true
            ];
        }
        return $cep;
    }
}
