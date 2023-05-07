<?php

namespace App\Http\Controllers;

use App\Models\fotos;
use Illuminate\Http\Request;

class FotosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('VistaFoto.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('VistaFoto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
        return redirect()->route('foto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(fotos $fotos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fotos $fotos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, fotos $fotos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fotos $fotos)
    {
        //
    }
}
