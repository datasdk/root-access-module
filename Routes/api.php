<?php

use Orion\Facades\Orion;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'api.root-access.',
    'prefix' => 'root-access',
    'middleware' => [
        'auth:api', 
        'role:admin'
    ] 
], function () {
  

    Route::get('/loginAsUser/{id}', 'Api\RootAccessController@loginAsUserRedirect');


    Route::post('/loginAsUser/{id}', 'Api\RootAccessController@loginAsUser');


});
