<?php

namespace App\Http\Controllers;

use App\Models\album_evento;
use App\Models\fotos;
use App\Models\Evento;
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
        $id = auth()->user()->id;
        $event = Evento::where('id_fotoestudio', '=', $id)->latest()->first();
        $d = $request->file('imagenes');
        // dd($d[0]);
        dd($event);
        dd($request);

        if ($event != null) {
            $id = auth()->user()->id;
            $album = new album_evento();
            $album->nombre_album = $event->evento_name;
            $album->descripcion = $event->descripcion;
            $first_foto = $request->file('imagenes');
            $album->foto_path = $first_foto[0];



            $len = count($request->file('imagenes'));
            dd($len);
        if ($request->hasFile('imagenes')) {
            $file = $request->file('imagenes');
            $destino = 'img/fotosClientes/';
            $foto = time() . '-' . $file->getClientOriginalName();
            $subirImagen = $request->file('imagenes')->move($destino, $foto);
        } else {
            $foto = "default.png";
        }


            foreach ($request->file('imagenes')->move($destino, $file->getClientOriginalName()) as $imagen) {
                // Guardar la imagen en la carpeta public/storage/fotos
                $ruta = $imagen->store('public/fotos');
                // Crear un nuevo registro en la base de datos para la imagen
                $f = new fotos();
                $f->foto_pach = $ruta;
                $f->id_fotoestudio = $event->id_organizador;
                $f->id_evento = $event->id;
                $f->id_album_evento = $request->a;
                $f->save();
            }
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
