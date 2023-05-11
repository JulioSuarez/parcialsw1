<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evento;
use App\Models\organizador;
use App\Models\album_evento;
use Illuminate\Http\Request;
use App\Models\album_cliente;
use App\Models\invitacion_evento;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

class OrganizadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = auth()->user()->id;
        // dd($id);
        $event = Evento::where('id_organizador', '=', $id)->get();
        $coleccion = collect([]);
        // dd($coleccion);
        foreach ($event as $e) {
            // dd($e);
            $album = album_evento::where('id_evento', '=', $e->id)
                ->where('estado', '=', 0)->first();
            // dd($album);
            if (!is_null($album)) {
                $coleccion->merge($album->id);
            }
        }
        $albunes = album_evento::get();
        // dd($coleccion);
        $eventos = Evento::join('users', 'users.id', 'eventos.id_fotoestudio')
            ->select('eventos.*', 'users.name as fotoestudio', 'users.profile_photo_path as fotostudio_perfil')->get();
        // dd($eventos);

        // seccion para saver la cantidad de envitados que tiene mi evento
        $invitados = 0;
        foreach ($eventos as $e) {
            $i = invitacion_evento::where('id_evento', '=', $e->id)->first();
            $invitados = $invitados + 1;
        }


        return view('VistaEventos.index', compact('eventos', 'coleccion', 'albunes', 'invitados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function crearEvento()
    {
        $fotoestudios = User::all();
        return view('VistaEventos.create', compact('fotoestudios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $id = auth()->user()->id;
        // seccion foto del evento
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destino = 'img/Eventos/';
            $foto = time() . '-' . $file->getClientOriginalName();
            $subirImagen = $request->file('foto')->move($destino, $foto);
        } else {
            $foto = "default.png";
        }

        // seccion evento
        $e = new Evento();
        $e->evento_name = $request->evento_name;
        $e->descripcion = $request->descripcion;
        $e->fecha = $request->fecha;
        $e->hora = $request->hora;
        $e->horafin = $request->horafin;
        $e->lugar = $request->lugar;
        $e->estado = '0';   //  Activo = 0 | Terminado = 1
        $e->id_organizador = $id;
        $e->id_fotoestudio = $request->fotoestudio;
        $e->foto = $foto;
        $e->save();

        // seccion album del evento
        $a = new album_evento();
        $a->nombre_album = $request->evento_name;
        $a->descripcion = $request->descripcion;
        $a->portada = $foto;
        $a->estado = '0'; //pendiente (no tiene fotos cargadas)
        $a->id_evento = $e->id;
        $a->save();


        // seccion poner en ocupado al fotografo
        $estado = User::where('id', '=', $id)->first();
        $estado->estado = 1;
        $estado->save();

        // seccion de renderizar imagen de portada del evento
        // $img = Image::make($request->file('foto'))
        //     ->resize(300, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->insert('public/img/watermark.png')->save($destino . $foto);

        // seccion de invitacion
        // genero el qr de la invitacion
        $qr = QrCode::format('png')->size(500)->generate('Estas Invitado a ' . $request->evento_name, '../public/qrcodes/' . $foto);
        // paso la invitacion a todos los usuarios con rol cliente
        $u = User::get();
        foreach ($u as $c) {
            if ($c->getRole() == 2) {
                $i = new invitacion_evento();
                $i->entrada_qr = $foto;
                $i->id_cliente = $c->id;
                $i->id_evento = $e->id;
                $i->save();
            }
        }

        return redirect()->route('evento.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(organizador $organizador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(organizador $organizador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, organizador $organizador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(organizador $organizador)
    {
        //
    }

    public function reportes(){
        return view('VistaReportes.organizadores');
    }
}
