<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\fotos;
use App\Models\Evento;
use App\Models\fotoestudio;
use App\Models\album_evento;
use Illuminate\Http\Request;
use Aws\Exception\AwsException;
use App\Models\invitacion_evento;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Aws\Rekognition\RekognitionClient;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

class FotoestudioController extends Controller
{

    public function compararFotos(Request $request)
    {


        // aqui tengo las fotos de perfil de todos mis clientes
        $fotosPerfiles = User::all();
        $fotosAlbumEvento = album_evento::all();
        //solo albun aprobado 0:pendiente 1:aprobado 2:terminado(que ya hizo el rekonigtion)
        $coleccion = collect();
        foreach ($fotosPerfiles as $f) {
            $coleccion = $coleccion->merge($f->profile_photo_path);
        }
        dd($coleccion);
        // $len = count($fotoAlmacenada);
        // dd($len);
        // for ($i = 0; $i < $len; $i++) {
        //     hacer algo xD
        // }




        $fotoSubida = album_evento::get();
        $len = count($fotoSubida);
        dd($len);
        for ($i = 0; $i < $len; $i++) {
            // vamos a recorrer cada una de las fotos que subimos


            //aqui adentro are otro for que recorra la tabla clientes y que me muestre solo el atributo foto de perfil
            $fotoAlmacenada = User::get();
            foreach ($fotoAlmacenada as $foto) {
                $fotoAlmacenada = $foto->foto_perfil;
                dd($fotoAlmacenada);
                //aqui tengo los album de fotos que subi de 1 solo evento
                //con esto reduzco la cantidad de tokens del servicio del rekognition y abarato costos (eficiencia)

                //dentro de este for pondre la funcion de comparar caras

                // si la similitud es >= 70% entonces
                // cargar esa foto a la tabla de ofertar_foto (es como hacer un store)
                /*
                donde esta tabla tiene lo siguientes atributos
                atributo        descripcion
                id_oferta_foto  identificador unico
                id_cliente      este atributo tendra el id del cliente que hizo FaceMatch
                id_foto         esta sera la foto
                id_evento       este sea el id del evento donde se tomo la foto
                id_foto_estudio este sera el id del foto estudio que tomo la foto
            */
            }
        }


        $fotoSubida = album_evento::get();
        foreach ($fotoSubida as $f) {
            $fotoSubida = $f->foto_path;
        }

        // voy a subir un album con las fotos de un evento con el id de ese albun en particular
        // puedo compara las foto con las fotos de los perfiles de todos mis clientes




        $rekognition = new RekognitionClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);


        $resultado = $rekognition->compareFaces([
            'SimilarityThreshold' => 70,
            'SourceImage' => [
                'Bytes' => file_get_contents($fotoSubida),
            ],
            'TargetImage' => [
                'Bytes' => file_get_contents($fotoAlmacenada),
            ],
        ]);

        $similitud = $resultado['FaceMatches'][0]['Similarity'];

        if ($similitud >= 70) {
            // Las fotos son similares
        } else {
            // Las fotos no son similares
        }
    }

    public function index()
    {
        $fotoSubida = User::get();

        $id = auth()->user()->id;
        $event = Evento::where('id_fotoestudio', '=', $id)->get();
        $coleccion = collect([]);
        // dd($coleccion);
        foreach ($event as $e) {
            // dd($e);
            $album = album_evento::where('id_evento', '=', $e->id)
                ->where('estado', '=', 0)->first();
            // dd($album->id);
            if (!is_null($album)) {
                $coleccion = $coleccion->merge($album->id);
            }
            // dd($coleccion);
        }
        $albunes = album_evento::get();
        // $eventos = Evento::get();
        $eventos = Evento::join('users', 'users.id', 'eventos.id_fotoestudio')
            ->join('album_eventos', 'album_eventos.id_evento', '=', 'eventos.id')
            ->where('eventos.estado', '=', '0')
            ->select('eventos.*', 'users.name as fotoestudio', 'users.profile_photo_path as fotostudio_perfil', 'album_eventos.id as id_album_evento')->get();
        // dd($eventos);

        // seccion para saver la cantidad de envitados que tiene mi evento
        $invitados = 0;
        foreach ($eventos as $e) {
            $i = invitacion_evento::where('id_evento', '=', $e->id)->first();
            $invitados = $invitados + 1;
        }

        // $habilitado = Evento::where('id_fotoestudio', '=', $id)
        //     ->where('eventos.fecha', '>', now())
        //     ->where('eventos.estado', '=', '0')->get();
        // dd($habilitado);


        return view('VistaFotoestudio.index', compact('fotoSubida', 'coleccion', 'event', 'eventos', 'invitados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $r)
    {
        // dd($r);
        $id = auth()->user()->id;
        $a = Evento::join('album_eventos', 'album_eventos.id_evento', '=', 'eventos.id')
            ->where('album_eventos.id', '=', $r->id)
            ->where('eventos.id_fotoestudio', $id)
            ->select('eventos.*', 'album_eventos.id as id_album_evento')->first();
        // dd($eventos);

        return view('VistaFotoestudio.create', compact('a'));
    }

    /**
     * Fotografo Store subir fotos del evento
     */
    public function store(Request $request)
    {
        // dd($request);
        // 1 subir las fotos del evento que elegimos y vincular con el album de ese evento
        // 2 subir las fotos originales y renderizadas

        $contador = 0;
        $watermark = 'http://imgfz.com/i/o98QYGl.png';
        $watermarkOK = Image::make($watermark);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                // dd($imagen);
                //almaceno las imagenes en mi almacen local para mis pruebas
                $destino = 'img/fotosClientes/';
                $foto = time() . '-' . $imagen->getClientOriginalName();
                $subirImagen = $imagen->move($destino, $foto);
                $rutaImagen = $subirImagen->getPathname();
                // dd($subirImagen);

                // renderizar las fotos y marcar de agua
                $img = Image::make($rutaImagen)
                ->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->insert($watermarkOK,'center')->blur(1)
                ->save($rutaImagen);

                $contador = $contador + 1;

                // Crear un nuevo registro en la base de datos local
                $f = new fotos();
                $f->foto_original = $foto;
                $f->foto_renderizada = $destino . $foto;
                $f->estado = 0;
                $f->id_fotoestudio = $request->evento_id_fotoestudio;
                $f->id_evento = $request->evento_id;
                $f->id_album_evento = $request->evento_id_album_evento;
                $f->save();
            }
        } else {
            return redirect()->route('fotoestudio.index');
        }

        // actualizar el estado del album a 1: fotos cargadas
        $album_evento = album_evento::where('id', '=', $request->evento_id_album_evento)->first();
        $album_evento->estado = 1;
        $album_evento->save();

        //liberar al fotografo poner su estado en 0: disponible
        $fotografo = User::where('id', $request->evento_id_fotoestudio)->first();
        $fotografo->estado = 0;
        $fotografo->save();

        return redirect()->route('fotoestudio.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(fotoestudio $fotoestudio)
    {
        dd($fotoestudio);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fotoestudio $fotoestudio)
    {
        dd($fotoestudio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, fotoestudio $fotoestudio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fotoestudio $fotoestudio)
    {
        //
    }
    public function reportes()
    {
        return view('VistaReportes.fotoestudio');
    }
}
