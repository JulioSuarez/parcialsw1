<?php

namespace App\Http\Controllers;

use App\Models\sintaxi;
use App\Models\atributo;
use Illuminate\Http\Request;

class SintaxiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sintaxis = sintaxi::all();
        return view('VistaDiagramas.sintaxis',compact('sintaxis'));
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
        $s = new sintaxi();
        $s->name = $request->nombre;
        $s->save();

        return redirect()->route('sintaxis.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(sintaxi $sintaxi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sintaxi $sintaxi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sintaxi $sintaxi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sintaxi $sintaxi)
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
}
