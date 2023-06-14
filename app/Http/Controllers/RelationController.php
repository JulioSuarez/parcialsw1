<?php

namespace App\Http\Controllers;

use App\Models\relation;
use App\Models\relation_tipo;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relaciones = relation_tipo::all();
        return view('VistaDiagramas.relaciones',compact('relaciones'));
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
        $r = new relation_tipo();
        $r->name = $request->nombre;
        $r->save();

        return redirect()->route('relaciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(relation $relation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(relation $relation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, relation $relation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(relation $relation)
    {
        //
    }

    public function storeTipoRelation(){
        
    }
}
