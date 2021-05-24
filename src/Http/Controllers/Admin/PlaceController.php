<?php

namespace Locaravel\Http\Controllers\Admin;

use Locaravel\Models\Travels\Place;
use Pedreiro\CrudController;

class PlaceController extends Controller
{
    use CrudController;

    public function __construct(Place $model)
    {
        $this->model = $model;
        parent::__construct();
    }
}
