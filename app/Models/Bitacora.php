<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'fecha_creacion', 'hora_bitacoora', 'descripcion_bitacora', 'user_id'
    ];
}
