<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ETL(){//menu Admin ETL
        return view('/ETL');
    }
    public function respaldo_restauracion(){//menu Admin respaldo y restauracion
        return view('/respaldo_restauracion');
    }
}
