<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    public function cuenta(){
        
        return $this->belongsTo(Cuenta::class);
    }
   
}
