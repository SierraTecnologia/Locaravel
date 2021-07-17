<?php


if (\Muleta\Modules\Features\Resources\FeatureHelper::hasActiveFeature(
    [
        'locais',
    ]
)){
    Route::resource('/places', 'PlaceController')->parameters([
        'places' => 'id'
    ]);
}



Route::resource('addresses', 'AddressController');
