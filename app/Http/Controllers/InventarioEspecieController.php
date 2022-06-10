<?php

namespace App\Http\Controllers;

use App\Especie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\Rol;

class InventarioEspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}
    public function inventario_especies()
    {

        return view('reportes.inventario_especies', ['usuario' => Rol::rol()]);
    }
    public function especies_disponibles()
    {

        return view('reportes.especies_disponibles', ['usuario' => Rol::rol()]);
    }
    public function index()
    {
        $especie = Especie::orderBy('id', 'desc')->where('estado', 1)->get();

        return view('admin.especies.index', ['especie' => $especie]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.especies.create');
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
            'especie_nombre' => 'required|max:255',
            'especie_costo' => 'required|max:255|numeric',
            'especie_valorVenta' => 'required|max:255|numeric',
            'especie_numeracionInicial' => 'required|max:255|numeric',
            'especie_numeracionFinal' => 'required|max:255|numeric',
            'especie_cantidad' => 'required|numeric'

        ]);

        $especie = new Especie();

        $especie->nombre = $request->especie_nombre;
        $especie->costo = $request->especie_costo;
        $especie->valorVenta = $request->especie_valorVenta;
        $especie->numeracionInicial = $request->especie_numeracionInicial;
        $especie->numeracionFinal = $request->especie_numeracionFinal;
        $especie->cantidad = $request->especie_cantidad;

        $especie->save();



        return redirect('/especie');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function show(Especie $especie)
    {
        return view('admin.especies.show', ['especie' => $especie]);
        //    return $especie;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function edit(Especie $especie)
    {
        return view('admin.especies.edit', ['especie' => $especie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especie $especie)
    {
        $request->validate([
            'especie_nombre' => 'required|max:255',
            'especie_costo' => 'required|max:255',
            'especie_valorVenta' => 'required|max:255',
            'especie_numeracionInicial' => 'required|max:255',
            'especie_numeracionFinal' => 'required|max:255',
            'especie_cantidad' => 'required|max:255'

        ]);

        $especie->nombre = $request->especie_nombre;
        $especie->costo = $request->especie_costo;
        $especie->valorVenta = $request->especie_valorVenta;
        $especie->numeracionInicial = $request->especie_numeracionInicial;
        $especie->numeracionFinal = $request->especie_numeracionFinal;
        $especie->cantidad = $request->especie_cantidad;

        $especie->save();



        return redirect('/especie');
        //dd($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Especie $especie)
    {
        Especie::where('id', '=', $especie->id)->update(['estado' => 0]);
        return redirect('/especie');
    }
}
