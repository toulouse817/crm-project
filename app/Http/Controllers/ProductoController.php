<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Muestra la lista de productos junto con su cliente.
     */
    public function index()
    {
        $productos = Producto::with('cliente')->get();
        return response()->json($productos, 200);
    }

    /**
     * Guarda un nuevo producto en la base de datos local.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'cliente_id' => 'nullable|exists:clientes,id',
            'imagen' => 'nullable|string'
        ]);

        $producto = Producto::create($validated);

        // Cargar la relación para la respuesta
        return response()->json($producto->load('cliente'), 201);
    }

    /**
     * Actualiza un producto existente en la base de datos local.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'cliente_id' => 'nullable|exists:clientes,id',
            'imagen' => 'nullable|string'
        ]);

        $producto->update($validated);

        // Retornar con el cliente asignado
        return response()->json($producto->load('cliente'), 200);
    }

    /**
     * Elimina un producto de la base de datos local.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado correctamente.'], 200);
    }
}
