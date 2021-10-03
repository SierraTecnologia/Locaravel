<?php

namespace Locaravel\Saas;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Log;

class PushService extends Service
{

    public function __construct()
    {
        $this->url = 'https://onesignal.com/api';
        $this->companyToken = false;
    }

    /**
     * @return true
     */
    public function send($params): bool
    {
        Log::info('[Onesignal] Enviando data: '. print_r($params, true));
        $response = $this->postWithAuthentication(
            'v1/notifications',
            $params,
            'NTViNjJiYjAtNDAyNy00NmM0LWJmNmUtYWI4OTRkODExMWUz'
        );
        Log::info('[Onesignal] Recebendo resposta: '. print_r($response, true));

        return true;
    }
    
}
