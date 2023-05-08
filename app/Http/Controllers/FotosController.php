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
        // dd($request);

        // if ($request->hasFile('foto_perfil')) {
        //     $file = $request->file('foto_perfil');
        //     $destino = 'img/fotosClientes/';
        //     $foto_perfil = time() . '-' . $file->getClientOriginalName();
        //     $subirImagen = $request->file('foto_perfil')->move($destino, $foto_perfil);
        // } else {
        //     $foto = "default.png";
        // }

        $id = auth()->user()->id;
        foreach ($request->file('imagenes') as $imagen) {
            // Guardar la imagen en la carpeta public/storage/fotos
            $ruta = $imagen->store('public/fotos');
            // Crear un nuevo registro en la base de datos para la imagen
            // dd($ruta);
            $f = new fotos();
            $f->foto_pach = $ruta;
            $f->id_fotoestudio = $id;
            $f->id_evento = $request->a;
            $f->id_album_fotos = $request->a;
            $f->save();
        }
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
