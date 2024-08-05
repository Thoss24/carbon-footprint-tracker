<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/my-feed', function () {
        return view('feed');
    })->name('my-feed');

    Route::get('/log-household-carbon-footprint', function () {
        return view('household-carbon-footprint');
    })->name('household-carbon-footprint');

    Route::get('/log-transport-carbon-footprint', function () {
        return view('transport-carbon-footprint');
    })->name('transport-carbon-footprint');

    Route::get('/log-secondary-carbon-footprint', function () {
        return view('secondary-carbon-footprint');
    })->name('secondary-carbon-footprint');

});



