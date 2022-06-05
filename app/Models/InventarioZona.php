<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventarioZona extends Model
{
    public function inventario(){
        
        return $this->belongsTo(Venta::class);
    }
}
