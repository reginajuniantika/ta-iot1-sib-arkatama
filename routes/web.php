<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sensor', function () {
    return view('pages.sensor');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/ledcontrol', function () {
    return view('pages.ledcontrol');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pengguna', function () {
    return view('pages.pengguna');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
