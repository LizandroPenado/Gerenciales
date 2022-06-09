<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    protected $fillable = [
        'id', 'nombre_especie', 'costo_especie', 'valorVenta', 'numeracionInicial', 'numeracionFinal', 'cantidad_especie', 'estado_especie', 'inventario_id', 'updated_at'
    ];
}
