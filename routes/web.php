<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
});

// Rutas almacenadas 
// GET
Route::get('get', 'App\Http\Controllers\Concesionario@getAllVehicles')->name('getAll');
Route::get('get/{id}', 'App\Http\Controllers\Concesionario@getVehicleById')->name('getById');
// POST
Route::post('create', 'App\Http\Controllers\Concesionario@createVehicle')->name('createVehicle');




// Token CSRF
Route::get('token', function () {
    return csrf_token(); 
});