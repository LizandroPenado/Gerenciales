<?php

namespace App\Http\Controllers;

use App\Cheque;
use App\Cuenta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cheque = Cheque::orderBy('id', 'desc')->get();
        return view('admin.cheques.index', ['cheque' => $cheque]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cheques.create');
    }

    public function getCuentasBancarias(Request $request)
    {   
        $banco=$request->nombre_banco;
        $result=Cuenta::where('banco',$banco)->get();
        
            $cuentasArray = array();
 
            foreach($result as $cuenta){
                $cuentasArray[$cuenta->id] = $cuenta->ncuenta;
            }
 
            return response()->json($cuentasArray);
         
        return view('admin.cheques.create');
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
            'cheque_banco' => 'required|max:500',
            'cheque_ncuenta' => 'required|max:300',
            'cheque_recibe' => 'required|max:300',
            'cheque_cantidad' => 'required|max:300',
            'cheque_cantidadletras' => 'required|max:500',
            'cheque_fecha' => 'required|max:500',


        ]);

        $cheque = new Cheque();

        $cheque->banco = $request->cheque_banco;
        $cheque->ncuenta = $request->cheque_ncuenta;
        $cheque->recibe = $request->cheque_recibe;
        $cheque->cantidad = $request->cheque_cantidad;
        $cheque->cantidadletras = $request->cheque_cantidadletras;
        $cheque->fecha = $request->cheque_fecha;
 

        $cheque-> save();
        
        $cuenta=Cuenta::find($request->cheque_ncuenta);
        
        $cuenta->saldo=$cuenta->saldo- floatval($request->cheque_cantidad);
        $cuenta->update();
        return redirect('/cheque');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function show(Cheque $cheque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function edit(Cheque $cheque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cheque $cheque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cheque $cheque)
    {
        //
    }
}
