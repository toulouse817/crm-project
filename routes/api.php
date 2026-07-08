<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

// Laravel añade el prefijo /api automáticamente a este archivo
Route::get('/productos', [ProductoController::class, 'index']);
