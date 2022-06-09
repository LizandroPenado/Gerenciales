<?php

namespace App\Http\Controllers;

use App\InventarioZona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class InventarioZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inventario_zonas(Request $request)
    {

        $comparar = ">=";
        if($request->comparacion == "Menor"){
            $comparar = "<=";
        }

        $zona = DB::table('zonas')
            ->select('zonas.id', 'zonas.nombre_zona')
            ->get();

        /*  $inventario = DB::table('inventario_zonas')
            ->join('especies', 'especies.inventario_id', '=', 'inventario_zonas.id')
            ->join('zonas', 'zonas.id', '=', 'inventario_zonas.zona_id')
            ->select('especies.nombre', 'especies.costo', 'especies.valorVenta', 'especies.cantidad', 'especies.estado', 'zonas.nombre')
            ->get(); */

        if ($request->zona_id != "" && $request->costo != "" && $request->cantidad != "") {

            $inventario = DB::table('inventario_zonas')
                ->join('especies', 'especies.inventario_id', '=', 'inventario_zonas.id')
                ->join('zonas', 'zonas.id', '=', 'inventario_zonas.zona_id')
                ->select('especies.nombre_especie', 'especies.costo_especie', 'especies.valorVenta', 'especies.cantidad_especie', 'inventario_zonas.nombre_inventario', 'zonas.nombre_zona')
                ->where('zonas.id', '=', $request->zona_id)
                ->where('especies.costo_especie', $comparar, $request->costo)
                ->where('especies.cantidad_especie', $comparar, $request->cantidad)
                ->get();
        } else if ($request->zona_id != "" && $request->costo != "") {

            $inventario = DB::table('inventario_zonas')
                ->join('especies', 'especies.inventario_id', '=', 'inventario_zonas.id')
                ->join('zonas', 'zonas.id', '=', 'inventario_zonas.zona_id')
                ->select('especies.nombre_especie', 'especies.costo_especie', 'especies.valorVenta', 'especies.cantidad_especie', 'inventario_zonas.nombre_inventario', 'zonas.nombre_zona')
                ->where('zonas.id', '=', $request->zona_id)
                ->where('especies.costo_especie', $comparar, $request->costo)
                ->get();
        } else if ($request->zona_id != "" && $request->cantidad != "") {

            $inventario = DB::table('inventario_zonas')
                ->join('especies', 'especies.inventario_id', '=', 'inventario_zonas.id')
                ->join('zonas', 'zonas.id', '=', 'inventario_zonas.zona_id')
                ->select('especies.nombre_especie', 'especies.costo_especie', 'especies.valorVenta', 'especies.cantidad_especie', 'inventario_zonas.nombre_inventario', 'zonas.nombre_zona')
                ->where('zonas.id', '=', $request->zona_id)
                ->where('especies.cantidad_especie', $comparar, $request->cantidad)
                ->get();
        } else if ($request->costo != "" && $request->cantidad != "") {

            $inventario = DB::table('inventario_zonas')
                ->join('especies', 'especies.inventario_id', '=', 'inventario_zonas.id')
                ->join('zonas', 'zonas.id', '=', 'inventario_zonas.zona_id')
                ->select('especies.nombre_especie', 'especies.costo_especie', 'especies.valorVenta', 'especies.cantidad_especie', 'inventario_zonas.nombre_inventario', 'zonas.nombre_zona')
                ->where('especies.costo_especie', $comparar, $request->costo)
                ->where('especies.cantidad_especie', $comparar, $request->cantidad)
                ->get();
        } else if ($request->zona_id != "") {

            $inventario = DB::table('inventario_zonas')
                ->join('especies', 'especies.inventario_id', '=', 'inventario_zonas.id')
                ->join('zonas', 'zonas.id', '=', 'inventario_zonas.zona_id')
                ->select('especies.nombre_especie', 'especies.costo_especie', 'especies.valorVenta', 'especies.cantidad_especie', 'inventario_zonas.nombre_inventario', 'zonas.nombre_zona')
                ->where('zonas.id', '=', $request->zona_id)
                ->get();
        } else if ($request->costo != "") {

            $inventario = DB::table('inventario_zonas')
                ->join('especies', 'especies.inventario_id', '=', 'inventario_zonas.id')
                ->join('zonas', 'zonas.id', '=', 'inventario_zonas.zona_id')
                ->select('especies.nombre_especie', 'especies.costo_especie', 'especies.valorVenta', 'especies.cantidad_especie', 'inventario_zonas.nombre_inventario', 'zonas.nombre_zona')
                ->where('especies.costo_especie', $comparar, $request->costo)
                ->get();
        } else if ($request->cantidad != "") {

            $inventario = DB::table('inventario_zonas')
                ->join('especies', 'especies.inventario_id', '=', 'inventario_zonas.id')
                ->join('zonas', 'zonas.id', '=', 'inventario_zonas.zona_id')
                ->select('especies.nombre_especie', 'especies.costo_especie', 'especies.valorVenta', 'especies.cantidad_especie', 'inventario_zonas.nombre_inventario', 'zonas.nombre_zona')
                ->where('especies.cantidad_especie', $comparar, $request->cantidad)
                ->get();
        } else {
            $inventario = DB::table('inventario_zonas')
                ->join('especies', 'especies.inventario_id', '=', 'inventario_zonas.id')
                ->join('zonas', 'zonas.id', '=', 'inventario_zonas.zona_id')
                ->select('especies.nombre_especie', 'especies.costo_especie', 'especies.valorVenta', 'especies.cantidad_especie', 'inventario_zonas.nombre_inventario', 'zonas.nombre_zona')
                ->get();
        }

        //return view('admin.inventarioZona.index',['inventario' => $inventario]);
        return view('reportes.inventario_zonas')->with("inventario", $inventario)->with("zona", $zona);
        //return view('reportes.inventario_zonas');
    }
    public function index()
    {
        $inventarioZonas = DB::select('SELECT zonas.nombre AS zona,especies.nombre AS nombreEspecie,SUM(inventario_zonas.cantidad) AS cantidad FROM inventario_zonas INNER JOIN zonas ON inventario_zonas.zona = zonas.id INNER JOIN especies ON inventario_zonas.nombreEspecie = especies.id GROUP BY inventario_zonas.zona,inventario_zonas.nombreEspecie');

        return view('admin.inventarioZona.index', ['inventarioZonas' => $inventarioZonas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InventarioZona  $inventarioZona
     * @return \Illuminate\Http\Response
     */
    public function show(InventarioZona $inventarioZona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InventarioZona  $inventarioZona
     * @return \Illuminate\Http\Response
     */
    public function edit(InventarioZona $inventarioZona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InventarioZona  $inventarioZona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventarioZona $inventarioZona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InventarioZona  $inventarioZona
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventarioZona $inventarioZona)
    {
        //
    }
}
