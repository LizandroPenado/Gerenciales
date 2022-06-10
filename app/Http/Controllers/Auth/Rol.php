<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Rol
{     
    public static function rol(){//menu Admin ETL
        $usuario = Auth::user();
        $usuario = DB::table('users')
        ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
        ->where('users.id', $usuario->id)
        ->get()->pluck('role_id');
        
        return ($usuario);
    }
}
