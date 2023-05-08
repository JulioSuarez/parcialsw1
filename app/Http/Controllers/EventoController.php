<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('VistaEventos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('VistaEventos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = auth()->user()->id;
        // dd($request);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destino = 'img/Eventos/';
            $foto = time() . '-' . $file->getClientOriginalName();
            $subirImagen = $request->file('foto')->move($destino, $foto);
        } else {
            $foto = "default.png";
        }

        $e = new Evento();
        $e->evento_name = $request->evento_name;
        $e->descripcion = $request->descripcion;
        $e->fecha = $request->fecha;
        $e->hora = $request->hora;
        $e->lugar = $request->lugar;
        $e->id_organizador = $id;
        $e->foto = $foto;
        $e->save();
        return redirect()->route('evento.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
    {
        //
    }
}
