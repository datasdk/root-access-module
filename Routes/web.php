<?php

use Orion\Facades\Orion;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'root-access.',
    'prefix' => 'root-access',
    "middleware" => ["web","auth","role:admin|editor|analyzer|guest"],
], function () {
  

    Route::get('/loginAsUser/{id}', 'Api\RootAccessController@loginAsUserRedirect');


    Route::post('/loginAsUser/{id}', 'Api\RootAccessController@loginAsUser');


});
