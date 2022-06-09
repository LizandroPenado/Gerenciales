<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventarioZona extends Model
{
    protected $fillable = [
        'id', 'codigo_inventario', 'nombre_inventario', 'descripcion_inventario', 'zona_id', 'created_at','updated_at'
    ];

    public function inventario(){
        
        return $this->belongsTo(Venta::class);
    }
}
