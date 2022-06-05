<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Zona;
use Illuminate\Http\Request;

class ZonasController extends Controller
{
    public function index()
    {
        $zonas = Zona::orderBy('id', 'desc')->where('estado',1)->get();
        return view('admin.zonas.index',['zonas' => $zonas]);
    }

    public function create()
    {
        
        return view('admin.zonas.create');
    }

    public function store( Request $request)
    {
        zona::create([
            'nombre'      =>$request->nombre,
            'descripcion' => $request->descripcion
        ]);
        return redirect()->route('zonas.index');
    }

    public function edit($idZona)
    {
        $zona = zona::find($idZona);
        return view('admin.zonas.edit',['zona' => $zona]);
    }

    public function actualizarzona( Request $request)
    {
        // dd($request->all());
        zona::where('id',$request->id)
        ->update([
            'nombre'      =>$request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('zonas.index');
    }

    public function show($id)
    {
        $zona = zona::find($id);
      

        return view('admin.zonas.show',['zona' => $zona]);
    }

    public function destroy(Zona $zona)
    {
        Zona::where('id', '=' ,$zona->id)->update(['estado' => 0]);
        return redirect()->route('zonas.index');
    }
 }
