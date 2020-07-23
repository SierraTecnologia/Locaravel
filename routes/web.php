<?php

Route::group(
    ['middleware' => ['web']], function () {    
    





        Route::resource('addresses', 'AddressController');









    
    }
);    