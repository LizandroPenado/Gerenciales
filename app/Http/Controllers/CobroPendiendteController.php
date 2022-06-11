<?php

namespace App\Http\Controllers;

use App\Cobrador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\Rol;

class CobradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cobro_especies()
    {
        $comparar = ">=";
        if ($request->comparacion == "Menor") {
            $comparar = "<=";
        }
        $especie = DB::table('especies')
            ->select('especies.id', 'especies.especie_nombre')
            ->get();

        /*  $inventario = DB::table('inventario_zonas')
            ->join('especies', 'especies.inventario_id', '=', 'inventario_zonas.id')
            ->join('zonas', 'zonas.id', '=', 'inventario_zonas.zona_id')
            ->select('especies.nombre', 'especies.costo', 'especies.valorVenta', 'especies.cantidad', 'especies.estado', 'zonas.nombre')
            ->get(); */

        if ($request->estado_especie != "" && $request->costo != "" && $request->cantidad != "") {
            $inventario = DB::table('ventas')
                ->join('especies', 'especies.id', '=', 'ventas.especie_id')
                ->select('especies.nombre_especie', 'especies.costo_especie', 'especies.valorVenta', 'especies.cantidad_especie', 'especies.estado_especie', 'inventario_zonas.nombre_inventario', 'zonas.nombre_zona')
                ->where('especies.estado_especie', '=', $request->estado_especie)
                ->where('especies.costo_especie', $comparar, $request->costo)
                ->where('especies.cantidad_especie', $comparar, $request->cantidad)
                ->get();
        } else if ($request->especie_id != "" && $request->costo != "") {

            $inventario = DB::table('inventario_zonas')
                ->join('especies', 'especies.inventario_id', '=', 'inventario_zonas.id')
                ->join('zonas', 'zonas.id', '=', 'inventario_zonas.zona_id')
                ->select('especies.nombre_especie', 'especies.costo_especie', 'especies.valorVenta', 'especies.cantidad_especie', 'inventario_zonas.nombre_inventario', 'zonas.nombre_zona')
                ->where('zonas.id', '=', $request->zona_id)
                ->where('especies.costo_especie', $comparar, $request->costo)
                ->get();
        } else if ($request->especie_id != "" && $request->cantidad != "") {

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
        } else if ($request->especie_id != "") {

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
        return view('reportes.cobro_especies', ['usuario' => Rol::rol()])->with("especie", $especie);
    }
    public function cobros_zonas()
    {
        return view('reportes.cobros_zonas', ['usuario' => Rol::rol()]);
    }
    public function index()
    {
        $cobrador = Cobrador::orderBy('id', 'desc')->where('estado', 1)->get();

        return view('admin.cobradores.index', ['cobrador' => $cobrador]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cobradores.create');
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
            'cobrador_nombre' => 'required|max:500',
            'cobrador_sexo' => 'required|max:300',
            'cobrador_telefono' => 'required|max:300',
            'cobrador_fecha' => 'required|max:300',
            'cobrador_correo' => 'required|max:500',
            'cobrador_dui' => 'required|max:500',
            'cobrador_nit' => 'required|max:500'

        ]);

        $cobrador = new Cobrador();

        $cobrador->nombre = $request->cobrador_nombre;
        $cobrador->sexo = $request->cobrador_sexo;
        $cobrador->telefono = $request->cobrador_telefono;
        $cobrador->fecha_nacimiento = $request->cobrador_fecha;
        $cobrador->correo_electronico = $request->cobrador_correo;
        $cobrador->dui = $request->cobrador_dui;
        $cobrador->nit = $request->cobrador_nit;

        $cobrador->save();



        return redirect('/cobrador');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cobrador  $cobrador
     * @return \Illuminate\Http\Response
     */
    public function show(Cobrador $cobrador)
    {
        return view('admin.cobradores.show', ['cobrador' => $cobrador]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cobrador  $cobrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Cobrador $cobrador)
    {
        return view('admin.cobradores.edit', ['cobrador' => $cobrador]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cobrador  $cobrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cobrador $cobrador)
    {
        $request->validate([
            'cobrador_nombre' => 'required|max:500',
            'cobrador_sexo' => 'required|max:300',
            'cobrador_telefono' => 'required|max:300',
            'cobrador_fecha' => 'required|max:300',
            'cobrador_correo' => 'required|max:500',
            'cobrador_dui' => 'required|max:500',
            'cobrador_nit' => 'required|max:500'

        ]);

        $cobrador->nombre = $request->cobrador_nombre;
        $cobrador->sexo = $request->cobrador_sexo;
        $cobrador->telefono = $request->cobrador_telefono;
        $cobrador->fecha_nacimiento = $request->cobrador_fecha;
        $cobrador->correo_electronico = $request->cobrador_correo;
        $cobrador->dui = $request->cobrador_dui;
        $cobrador->nit = $request->cobrador_nit;


        $cobrador->save();



        return redirect('/cobrador');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cobrador  $cobrador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cobrador $cobrador)
    {
        Cobrador::where('id', '=', $cobrador->id)->update(['estado' => 0]);
        return redirect('/cobrador');
    }
}
