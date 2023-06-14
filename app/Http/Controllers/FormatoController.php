<?php

namespace App\Http\Controllers;

use App\Models\formato;
use App\Models\tipo_dato;
use Illuminate\Http\Request;

class FormatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sintaxis = formato::all();
        return view('VistaDiagramas.formato',compact('sintaxis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $s = new formato();
        $s->name = $request->nombre;
        $s->save();

        return redirect()->route('formato.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(formato $formato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(formato $formato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, formato $formato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(formato $formato)
    {
        //
    }

    public function tipoDato(){
        // dd($request);
        //esto es como un index de tipo de datos
        $td = tipo_dato::get();
        return view('VistaDiagramas.tipoDatos',compact('td'));
    }

    public function storeTipoDato(Request $request){
        // dd($request);
        $td = new tipo_dato();
        $td->name = request()->nombre;
        $td->save();

        return redirect()->route('tipo.dato')->with('success','Tipo de dato creado correctamente');
    }
}
