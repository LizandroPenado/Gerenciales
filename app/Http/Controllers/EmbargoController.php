<?php

namespace App\Http\Controllers;

use App\Embargo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmbargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $embargo = Embargo::orderBy('id', 'desc')->where('estado',1)->get();

        return view('admin.embargos.index', ['embargo' => $embargo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.embargos.create');
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
            'embargo_nombre' => 'required|max:700',
            'embargo_monto' => 'required|max:755|numeric',
            'embargo_referencia' => 'required|max:700',
            'embargo_estado' => 'max:255',

        ]);

        $embargo = new Embargo();

        $embargo->nombre = $request->embargo_nombre;
        $embargo->montoDescontar = $request->embargo_monto;
        $embargo->referencia = $request->embargo_referencia;
        $embargo->estadoEmbargo = 'Activo';


        $embargo-> save();

        return redirect('/embargo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Embargo  $embargo
     * @return \Illuminate\Http\Response
     */
    public function show(Embargo $embargo)
    {
        return view('admin.embargos.show', ['embargo' => $embargo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Embargo  $embargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Embargo $embargo)
    {
        return view('admin.embargos.edit',['embargo' => $embargo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Embargo  $embargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Embargo $embargo)
    {
        $request->validate([
            'embargo_nombre' => 'required|max:700',
            'embargo_monto' => 'required|max:700|numeric',
            'embargo_referencia' => 'required|max:700',
            'embargo_estado' => 'required|max:300'

        ]);

        $embargo->nombre = $request->embargo_nombre;
        $embargo->montoDescontar = $request->embargo_monto;
        $embargo->referencia = $request->embargo_referencia;
        $embargo->estadoEmbargo = $request->embargo_estado;


        $embargo-> save();

          

        return redirect('/embargo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Embargo  $embargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Embargo $embargo)
    {
        Embargo::where('id', '=' ,$embargo->id)->update(['estado' => 0]);
        return redirect('/embargo');
    }
}
