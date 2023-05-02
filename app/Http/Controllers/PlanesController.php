<?php

namespace App\Http\Controllers;

use App\Models\planes;
use Illuminate\Http\Request;

class PlanesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planes = planes::all();
        return view('VistaPlanes.index', compact('planes'));
        // return view('VistaPlanes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('VistaPlanes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'tipo_plan' => 'required',
        //     'precio' => 'required',
        // ]);
        $p = new planes();
        $p->tipo_plan = $request->tipo_plan;
        $p->precio = $request->precio;
        $p->save();
        return redirect()->route('planes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(planes $planes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(planes $planes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, planes $planes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(planes $planes)
    {
        //
    }
}
