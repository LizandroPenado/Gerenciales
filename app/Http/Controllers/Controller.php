<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\Rol;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function ETL(){//menu Admin ETL
        
        return view('/ETL', ['usuario' => Rol::rol()]);
    }
    public function respaldo_restauracion(){//menu Admin respaldo y restauracion

        return view('/respaldo_restauracion', ['usuario' => Rol::rol()]);
    }
}
