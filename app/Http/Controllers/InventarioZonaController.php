<?php

namespace App\Http\Controllers;

use App\InventarioZona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\Rol;


class InventarioZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inventario_zonas()
    { 

        return view('reportes.inventario_zonas', ['usuario' => Rol::rol()]);
    }
    public function index()
    { 
        $inventarioZonas = DB::select('SELECT zonas.nombre AS zona,especies.nombre AS nombreEspecie,SUM(inventario_zonas.cantidad) AS cantidad FROM inventario_zonas INNER JOIN zonas ON inventario_zonas.zona = zonas.id INNER JOIN especies ON inventario_zonas.nombreEspecie = especies.id GROUP BY inventario_zonas.zona,inventario_zonas.nombreEspecie');

        return view('admin.inventarioZona.index',['inventarioZonas' => $inventarioZonas]);
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
