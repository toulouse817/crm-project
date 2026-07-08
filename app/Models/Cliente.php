<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // Permitimos la asignación masiva de estos campos
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'codigo_pais',
        'pais',
        'ciudad',
        'avatar'
    ];

    /**
     * Obtiene los productos vendidos por este cliente.
     */
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
