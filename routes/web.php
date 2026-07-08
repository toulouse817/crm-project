<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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

// 4. Ruta proxy para evitar bloqueos de CORS con la API externa de países
Route::get('/paises-data', function () {
    try {
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name,cca2,idd,flags');
        return response()->json($response->json(), $response->status());
    } catch (\Exception $e) {
        return response()->json(['error' => 'No se pudo cargar la lista de países.'], 500);
    }
});
