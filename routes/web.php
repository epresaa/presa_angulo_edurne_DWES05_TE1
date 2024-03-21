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
// PUT
Route::put('update/{id}', 'App\Http\Controllers\Concesionario@updateVehicle')->name('updateVehicle');
// DELETE
Route::delete('delete/{id}', 'App\Http\Controllers\Concesionario@deleteVehicle')->name('deleteVehicle');
