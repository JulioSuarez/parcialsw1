<?php

namespace App\Http\Controllers;

use App\Models\diagrama;
use App\Models\invitado;
use Illuminate\Http\Request;

class InvitadoController extends Controller
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
    public function create(Request $request)
    {
        // dd($request);
        $diagrama = diagrama::find($request)->first();
        // $invitacion = invitado::where('id_diagrama','=',$diagrama->id)->first();

        // dd($diagrama);
        return view('VistaDiagramas.invitadoStore',compact('diagrama'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->id_diagrama);
        $invitados = explode(',', $request->input('invitados'));
        foreach ($invitados as $e){
            // dd($e);
            $i = new invitado();
            $i->user_email = $e;
            $i->id_diagrama = $request->id_diagrama;
            $i->save();
        }
        return redirect()->route('diagramas.index')->with('success','Invitaciones enviadas');
    }

    /**
     * Display the specified resource.
     */
    public function show(invitado $invitado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invitado $invitado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invitado $invitado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invitado $invitado)
    {
        //
    }
}
