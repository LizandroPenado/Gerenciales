<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuenta = Cuenta::orderBy('id', 'desc')->get();
        return view('admin.cuentas.index', ['cuenta' => $cuenta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cuentas.create');
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
            'cuenta_banco' => 'required|max:500',
            'cuenta_ncuenta' => 'required|max:300',
            'cuenta_nombre' => 'required|max:300',
            'cuenta_saldo' => 'required|max:300',
            'cuenta_estado' => 'required|max:500',


        ]);

        $cuenta = new Cuenta();

        $cuenta->banco = $request->cuenta_banco;
        $cuenta->ncuenta = $request->cuenta_ncuenta;
        $cuenta->nombre = $request->cuenta_nombre;
        $cuenta->saldo = $request->cuenta_saldo;
        $cuenta->estado = $request->cuenta_estado;
 

        $cuenta-> save();          

        return redirect('/cuenta');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $cuenta)
    {
     //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuenta $cuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuenta $cuenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuenta $cuenta)
    {
        //
    }
}
