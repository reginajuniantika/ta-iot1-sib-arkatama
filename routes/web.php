<?php

use App\Http\Controllers\Api\DataSensorcontroller;
use App\Http\Controllers\LedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DeviceController;

Route::get('/', function () {
    return view('layouts.landing');
});

Route::get('/dashboard', function () {
    $data['title'] = 'Dashboard';
        $data['breadcrumbs'][]= [
            'title' => 'Dashboard',
            'url' => route('dashboard')
        ];
    return view('pages.dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/ledcontrol', [LedController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('ledcontrol');

Route::get('/sensor', [SensorController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('sensor');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('users/destroy/{id}', [App\Http\Controllers\Api\UserController::class, 'destroy'])->name('users.destroy');

    //device
    Route::get('/sensor', [SensorController::class, 'index'])->name('sensor');
    Route::resource('devices', DeviceController::class);
    Route::get('/sensor/{id}', [DataSensorController::class, 'web_show']);

});

require __DIR__.'/auth.php';
