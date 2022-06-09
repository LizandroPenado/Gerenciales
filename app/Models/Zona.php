<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $fillable = [
        'id', 'nombre_zona', 'descripcion_zona', 'estado_zona', 'created_at','updated_at'
    ];

    public function cobradores()
    {
        return $this->belongsToMany(Cobrador::class, 'cobradors_zonas');
    }
}
