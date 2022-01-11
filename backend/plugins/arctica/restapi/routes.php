<?php

use Illuminate\Support\Facades\Route;

Route::get('api/portfolio/{slug}', ['uses' => '\Arctica\Restapi\Controllers\Project@getProject']);
Route::get('api/portfolio', ['uses' => '\Arctica\Restapi\Controllers\Project@getAllActive']);
Route::post('api/application', ['uses' => '\Arctica\Restapi\Controllers\Application@postApplication']);
Route::get('api', ['uses' => '\Arctica\Restapi\Controllers\Pages@mainPage']);
Route::get('api/equipment', ['uses' => '\Arctica\Restapi\Controllers\Pages@equipmentPage']);
Route::get('api/monitoring', ['uses' => '\Arctica\Restapi\Controllers\Pages@monitoringPage']);