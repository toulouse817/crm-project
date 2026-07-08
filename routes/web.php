<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;

// 1. Ruta para servir el HTML de tu SPA
Route::get('/', function () {
    return file_get_contents(public_path('index.html'));
});

// 2. Rutas para el CRUD de Productos
Route::get('/productos-data', [ProductoController::class, 'index']);
Route::post('/productos-data', [ProductoController::class, 'store']);
Route::put('/productos-data/{producto}', [ProductoController::class, 'update']);
Route::delete('/productos-data/{producto}', [ProductoController::class, 'destroy']);

// 3. Rutas para el CRUD de Clientes
Route::get('/clientes-data', [ClienteController::class, 'index']);
Route::post('/clientes-data', [ClienteController::class, 'store']);
Route::put('/clientes-data/{cliente}', [ClienteController::class, 'update']);
Route::delete('/clientes-data/{cliente}', [ClienteController::class, 'destroy']);
