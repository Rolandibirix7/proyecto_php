<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//rutas pero de momento sin roles solo para verlas
Route::get('/admin/dashboard', function () {
    return view('administrador.dashboard');
})->name('admin.dashboard');

Route::get('/listado', function () {
    return view('compartidas.lista');
})->name('compartidas.lista');
