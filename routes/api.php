<?php

use App\Http\Controllers\Api\DataSensorcontroller;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\MqSensorController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// CRUD
//Route::get('/users', [UserController::class, 'index']);
//Route::get('/users/{id}', [UserController::class, 'show']);
//Route::post('/users', [UserController::class, 'store']);
//Route::put('/users/{id}', [UserController::class, 'update']);
//Route::delete('/users/{id}', [UserController::class, 'destroy']);

//route group name api
Route::group(['as' =>'api.'], function (){

    // resource route
    Route::resource('users', UserController::class)
    ->except(['create', 'edit']);

    Route::resource('sensor/mq', MqSensorController::class)
    ->names('sensors.mq');

    Route::resource('devices', DeviceController::class)
    ->names('devices');

});

Route::get('/data', [DataSensorController::class, 'index']);
Route::post('/data', [DataSensorController::class, 'store']);
Route::get('/data/{id}', [DataSensorController::class, 'show']);


