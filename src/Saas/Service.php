<?php

namespace Locaravel\Saas;

use Log;

class Service
{
    protected $url = '';

    protected $business = false;

    protected $companyToken = false;

    protected function postWithCompanyToken($url, $params, $returnObject = true)
    {
        if (!isset($params['token'])) {
            $params['token'] = $this->companyToken;
        }
        return $this->post($url, $params, $returnObject);
    }

    protected function post($endPoint, $data, $returnObject = true)
    {
        $data = (is_array($data)) ? http_build_query($data) : $data; 
        // @todo Verificar
        // if ($this->business) {
        //     $data['business_token'] = $this->business;
        // }

        $curl = curl_init($this->url .'/'.$endPoint);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        curl_close($curl);
        if ($returnObject) {
            return json_decode($result);
        }
        return json_decode($result, true);
    }

    /**
     * @param string $endPoint
     * @param string $authenticationToken
     */
    protected function postWithAuthentication(string $endPoint, $data, string $authenticationToken, $returnObject = true)
    {
        $data = (is_array($data)) ? http_build_query($data) : $data; 
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url .'/'.$endPoint);
        curl_setopt(
            $curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'Authorization: Basic '.$authenticationToken)
        );
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
        // 'Authorization: Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj'));
        // NTViNjJiYjAtNDAyNy00NmM0LWJmNmUtYWI4OTRkODExMWUz
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);

        if ($returnObject) {
            return json_decode($result);
        }
        return json_decode($result, true);
    }

    protected function get(string $endPoint, $returnObject = true)
    {
        // make request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url .'/'.$endPoint); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec($curl);
        // handle error; error output
        if(curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            return false;
        }
        curl_close($curl);

        if ($returnObject) {
            return json_decode($result);
        }
        return json_decode($result, true);
    }



}
