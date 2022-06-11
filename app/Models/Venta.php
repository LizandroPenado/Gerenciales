<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'id', 'nombre_venta', 'cantidad_venta', 'total_venta', 'fecha_venta', 'updated_at'
    ];
    public function especie()
    {

        return $this->belongsTo(Especie::class);
    }
    public function zona()
    {

        return $this->belongsTo(Zona::class);
    }
}
