<?php

namespace App\Http\Controllers;

use App\Models\InventarioZona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\Rol;
use Barryvdh\DomPDF\Facade as PDF;


class InventarioZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inventario_zonas(Request $request)
    {

        $zona = DB::table('zonas')
            ->select('zonas.id', 'zonas.nombre_zona')
            ->get();

        $inventario = $this->filtros($request);

        return view('reportes.inventario_zonas', ['usuario' => Rol::rol()])->with("inventario", $inventario)->with("zona", $zona);
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

    public function downloadPdf(Request $request)
    {

        $inventario = $this->filtros($request);
        view()->share('pdf.inventario_zonas_pdf', $inventario);

        $reporte = "Reporte inventario de especies por zona";
        $pdf = PDF::loadView('pdf.inventario_zonas_pdf', ['inventario'=>$inventario]);

        return $pdf->stream('inventario_zona.pdf');
    }

    public function filtros($request){
        $comparar = ">=";
        if ($request->comparacion == "Menor") {
            $comparar = "<=";
        }

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

        return $inventario;
    }
}
