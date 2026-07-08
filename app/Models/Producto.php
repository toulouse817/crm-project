<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Permitimos la asignación masiva de estos campos
    protected $fillable = ['nombre', 'precio', 'cliente_id', 'imagen'];

    /**
     * Obtiene el cliente que vende este producto.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
