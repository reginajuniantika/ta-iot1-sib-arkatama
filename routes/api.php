<?php

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

//device
// Route::get('/devices', [DeviceController::class, 'index']);
// Route::post('/devices', [DeviceController::class, 'store']);
// Route::get('/devices/{id}', [DeviceController::class, 'show']);
// Route::put('/devices/{id}', [DeviceController::class, 'update']);
// Route::delete('/devices/{id}', [DeviceController::class, 'destroy']);






