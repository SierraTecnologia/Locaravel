<?php

namespace Locaravel\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $_version = null;

    public function __construct()
    {
        $this->_version = $this->getVersion();
    }

    /**
     * Tenta capturar um token para o business via SERVER, POST, ou GET
     * Caso não ache ele usa o token padrão da passepague
     */
    public function getVersion()
    {
        if (!empty($this->_version)) {
            return $this->_version;
        }

        if(!empty($_SERVER['HTTP_VERSION'])) {
            Log::info('Usando Version: '.$_SERVER['HTTP_VERSION']);
            return User::where('token', $_SERVER['HTTP_VERSION'])->first();
        }
            
        if(!empty($_POST['version'])) {
            Log::info('Usando Version: '.$_POST['version']);
            return User::where('token', $_POST['version'])->first();
        }
        
        if(!empty($_POST['VERSION'])) {
            Log::info('Usando Version: '.$_POST['VERSION']);
            return User::where('token', $_POST['VERSION'])->first();
        }
        
        if(!empty($_GET['version'])) {
            Log::info('Usando Version: '.$_GET['version']);
            return User::where('token', $_GET['version'])->first();
        }
        
        if(!empty($_GET['VERSION'])) {
            Log::info('Usando Version: '.$_GET['VERSION']);
            return User::where('token', $_GET['VERSION'])->first();
        }
        
        return $this->_version = config('app.version');
    }

    /**
     * Response com Array
     * [success] {Bollean}
     *
     * @return array
     *
     * @psalm-return array{success: mixed}
     */
    protected function defaultResponse(bool $success=true): array
    {
        return [
            'success' => $success
        ];
    }

    /**
     * Response com Array
     * [success] true
     * [message] {String}
     *
     * @return array
     */
    protected function responseWithMessage($message): array
    {
        $array = [
            'message' => $message
        ];
        return array_merge($this->defaultResponse(true), $array);
    }

    /**
     * Response com Array
     * [success] false
     * [message] {String}
     *
     * @return array
     */
    protected function responseWithErrorMessage($message): array
    {
        $array = [
            'message' => $message
        ];
        return array_merge($this->defaultResponse(false), $array);
    }

    /**
     * Response com Array
     * [success] false
     * [message] {String}
     *
     * @return array
     */
    protected function responseWithErrors($validation): array
    {
        $errors = $validation->messages();
        return $this->responseWithErrorMessage($errors[0]);
    }

    /**
     * Response com Array
     * [success] false
     * [data] {Array}
     *
     * @return array
     */
    protected function responseWithData($data): array
    {
        $array = [
            'data' => $data
        ];
        return array_merge($this->defaultResponse(true), $array);
    }

    
}
