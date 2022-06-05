<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cobrador extends Model
{
    public function zonas()
    {
        return $this->belongsToMany(Zona::class, 'cobradors_zonas');
    }

}
