<?php

namespace App\Http\Controllers;

use App\Models\diagrama;
use App\Models\User;
use Illuminate\Http\Request;

class DiagramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = [
            'nodeLabel' => 'Nodo 1',
            'x' => 20,
            'y' => 20,
            'width' => 80,
            'height' => 30,
        ];
        $usuarios = User::all();

        return view('VistaDiagramas.dojs', compact('usuarios'));
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
        $diagrama = new diagrama();
        $diagrama->nombre = $request->nombre;
        $diagrama->save();

        if($diagrama){
            return response()->json([
                'success' => true,
                'message' => 'Diagrama creado correctamente',
                'nombre' => $diagrama->nombre,
                'id' => $diagrama->id,
            ]);
        }
        return response()->json('Error al crear el diagrama');
    }

    /**
     * Display the specified resource.
     */
    public function show(diagrama $diagrama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(diagrama $diagrama)
    {
        return view('VistaDiagramas.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, diagrama $diagrama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(diagrama $diagrama)
    {
        //
    }
}
