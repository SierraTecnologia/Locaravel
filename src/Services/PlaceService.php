<?php

namespace Locaravel\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
// use Locaravel\Repositories\PlaceRepository;
use Locaravel\Models\Travels\Place;
use Muleta\Utils\Modificators\StringModificator;

class PlaceService
{
    // public function __construct(
    //     PlaceRepository $PlaceRepository
    // ) {
    //     $this->repo = $PlaceRepository;
    // }

    /**
     * @todo Terminar de Fazer
     */
    public static function import($data)
    {   
        $registerData = [];
        if (isset($data['Nome'])) {
            $registerData['name'] = $data["Nome"];
        }
        if (isset($data['tipo'])) {
            $registerData['tipo'] = $data["tipo"];
        }
        if (isset($data['cidade'])) {
            $registerData['cidade'] = $data["cidade"];
        }

        if (Place::where('name', $registerData['name'])->first()) {
            return true;
        }
        $Place = Place::createIfNotExistAndReturn($registerData);
        return true;
    }

}
