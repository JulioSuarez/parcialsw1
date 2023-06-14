<?php

namespace App\Http\Controllers;

use App\Models\atributo;
use App\Models\clase;
use Illuminate\Http\Request;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $clase = new clase();
        $clase->name = $request->nombre;
        $clase->id_diagrama = $request->id_diagrama;
        $clase->save();

        $c = clase::where('name', $request->nombre)->where('id_diagrama', $request->id_diagrama)->orderBy('id', 'desc')->first();

        $atributo = new atributo();
        $atributo->name = 'id';
        $atributo->clase_id = $c->id;
        $atributo->save();

        if($clase){
            return response()->json([
                'success' => true,
                'message' => 'Clase creada correctamente',
                'nombre' => $request->nombre,
                'clase id' => $c->id,
            ]);
        }
        return response()->json('Error al crear la clase');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function atributos(){
        return view('VistaDiagramas.atributos');
    }

    public function atributoStore(Request $request){

        $a = new atributo();
        $a->name = $request->nombre;
        $a->clase_id = $request->clase_id;
        $a->save();
    }
    public function atributoTipo(){
        return view('VistaDiagramas.atributoTipo');
    }
    public function atributoTipoStore(Request $request){
        //
    }
}
