<?php

namespace App\Http\Controllers;

use App\Especie;
use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Zona;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::orderBy('id', 'desc')->get();

        return view('admin.venta.index',['ventas' => $ventas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  $especies = DB::table('especies')->get()->pluck('nombre','id');
        //$zonas = DB::table('zonas')->get()->pluck('nombre','id');

        $especies=Especie::all(['id','nombre','cantidad','valorVenta']);
        $zonas=Zona::all(['id','nombre']);

        return view('admin.venta.create')->with('especies',$especies)->with('zonas',$zonas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'venta_name' => 'required|max:255',
            'especie' => 'required|max:255',
            'zona' => 'required|max:255',
            'cantidad' => 'required|max:255|numeric',
            'total' => 'required|max:255',
            

        ]);

        $venta = new Venta();

        $venta->name = $request->venta_name;
        $venta->especie_id = $request->especie[0];
        $venta->zona_id = $request->zona[0];
        $venta->cantidad = $request->cantidad;
        $venta->total = $request->total;
        // $especie->costo = $request->especie_costo;
        // $especie->valorVenta = $request->especie_valorVenta;
        // $especie->numeracionInicial = $request->especie_numeracionInicial;
        // $especie->numeracionFinal = $request->especie_numeracionFinal;
        // $especie->cantidad = $request->especie_cantidad;

        $venta-> save();

          

        return redirect('/venta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
