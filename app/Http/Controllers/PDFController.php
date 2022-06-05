<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Venta;

class PDFController extends Controller
{
    public function PDF(){
        $pdf = PDF::loadView('prueba');
        return $pdf ->stream('prueba.pdf');
    }

    public function PDFVentas(){
        $ventas = Venta::all();
        $pdf = PDF::loadView('ventas', compact('ventas'));
        return $pdf ->stream('ventas.pdf');
    }

}
