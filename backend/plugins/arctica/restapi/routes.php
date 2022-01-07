<?php

use Arctica\Restapi\Controllers\Project;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use October\Rain\Exception\ValidationException;

Route::prefix('api')->group(function () {
    Route::get('hello', function () {
        return response('hello rest api');
    });
}, 'hello');

// Route::prefix('api')->group(function () {
//     Route::get('hello/{name}', ['uses' => '\Arctica\Restapi\Controllers\Project@greet']);
// }, 'hello/{name}');

Route::get('api/project/{slug}', ['uses' => '\Arctica\Restapi\Controllers\Project@getProject']);
Route::get('api/portfolio', ['uses' => '\Arctica\Restapi\Controllers\Project@getAllActive']);
Route::post('api/application', ['uses' => '\Arctica\Restapi\Controllers\Application@postApplication']);
Route::get('api/main', ['uses' => '\Arctica\Restapi\Controllers\Pages@mainPage']);
Route::get('api/equipment', ['uses' => '\Arctica\Restapi\Controllers\Pages@equipmentPage']);
Route::get('api/monitoring', ['uses' => '\Arctica\Restapi\Controllers\Pages@monitoringPage']);