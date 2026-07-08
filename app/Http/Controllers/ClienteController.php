<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Muestra la lista de clientes con sus productos.
     */
    public function index()
    {
        $clientes = Cliente::with('productos')->get();
        return response()->json($clientes, 200);
    }

    /**
     * Almacena un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefono' => 'required|string|max:255',
            'codigo_pais' => 'required|string|max:10',
            'pais' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'avatar' => 'nullable|string'
        ]);

        $cliente = Cliente::create($validated);

        return response()->json($cliente, 201);
    }

    /**
     * Actualiza un cliente existente en la base de datos.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefono' => 'required|string|max:255',
            'codigo_pais' => 'required|string|max:10',
            'pais' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'avatar' => 'nullable|string'
        ]);

        $cliente->update($validated);

        // Retornar el cliente con sus productos actualizados
        return response()->json($cliente->load('productos'), 200);
    }

    /**
     * Elimina un cliente de la base de datos.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return response()->json(['message' => 'Cliente eliminado correctamente.'], 200);
    }
}
