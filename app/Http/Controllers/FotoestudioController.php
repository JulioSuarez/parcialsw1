<?php

namespace App\Http\Controllers;

// modelos
use App\Models\User;
use App\Models\fotos;
use App\Models\Evento;
use App\Models\fotoestudio;
use App\Models\album_evento;
use Illuminate\Http\Request;
use App\Models\invitacion_evento;
use Kreait\Firebase\Contract\Database;

// en desuso
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\Auth;

// servicios
use Aws\S3\S3Client;
use Intervention\Image\Facades\Image;
use Aws\Rekognition\RekognitionClient;
use Kreait\Laravel\Firebase\Facades\Firebase;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class FotoestudioController extends Controller
{
    // constructor para firebase
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = "servicios";
    }

    /////////////////////////////////////////////////////////////////////////////
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

        return view('VistaFotoestudio.index', compact('fotoSubida', 'coleccion', 'event', 'eventos', 'invitados'));
    }

    /////////////////////////////////////////////////////////////////////////////
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

    // Fotografo Store subir fotos del evento
    public function store(Request $request)
    {

        // dd($request);
        // crear un cliente de s3
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key' => 'AKIAYJVJS4X563AM7AFW',
                'secret' => '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',
            ],
        ]);

        // agrego los datos de la foto a mi tabla en firebase
        $database = Firebase::database();
        // dd($database);
        $postData  = [
            'id_fotoestudio' => $request->evento_id_fotoestudi,
            'id_evento' => $request->evento_id,
            'id_album_evento' => $request->evento_id_album_evento,

        ];
        $postRef = $this->database->getReference($this->tablename)->push($postData);

        // si se subio la foto a firebase continuamos con el proceso
        if ($postRef) {

            // TAREAS:
            // 1 subir las fotos del evento que elegimos y vincular con el album de ese evento
            // 2 subir las fotos originales a s3 y renderizadas a local
            // 3 cambiaremos los estados correspondientes de las fotos y album

            // creo mi imagen de marca de agua
            $watermark = 'http://imgfz.com/i/o98QYGl.png';
            $watermarkOK = Image::make($watermark);

            // verifico si se subio una imagen
            if ($request->hasFile('imagenes')) {
                // recorro cada imagen
                foreach ($request->file('imagenes') as $imagen) {
                    // dd($imagen);

                    //almaceno las imagenes en mi almacen local para renderizar
                    $destino = 'img/eventosFotos/';
                    $foto = time() . '-' . $imagen->getClientOriginalName();
                    $subirImagen = $imagen->move($destino, $foto);
                    $rutaImagen = $subirImagen->getPathname();
                    // dd($rutaImagen);


                    // Creo una copia para las originales
                    $nuevaUbicacion = 'img/eventosFotosOriginales/';
                    $nuevoNombre = time() . '-' . $imagen->getClientOriginalName();
                    copy($rutaImagen, $nuevaUbicacion . $nuevoNombre);
                    $ruta_copia = $nuevaUbicacion . $nuevoNombre;
                    // dd($ruta_copia);

                    // renderizar las fotos y agrego una marcar de agua
                    $img = Image::make($rutaImagen)
                        ->resize(500, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->insert($watermarkOK, 'center')->blur(1)
                        ->save($rutaImagen);


                    // guardar la imagen original en mi buket
                    $PhotoPath = public_path($ruta_copia);
                    $PhotoName = uniqid() . '.png';

                    $result = $s3->putObject([
                        'Bucket' => 'julico-bucket03',
                        'Key' => 'ruta/' . $PhotoName,
                        'Body' => fopen($PhotoPath, 'r'),
                        'ACL' => 'public-read',
                    ]);
                    // Genera una URL pública para acceder a la imagen
                    $foto_s3 = $result['ObjectURL'];

                    // Crear un nuevo registro en la base de datos local
                    $f = new fotos();
                    $f->foto_original = $foto_s3;
                    $f->foto_renderizada = $destino . $foto;
                    $f->estado = 0; // 0: pendiente | 1: aprobada | 2: rechazada
                    $f->id_fotoestudio = $request->evento_id_fotoestudio;
                    $f->id_evento = $request->evento_id;
                    $f->id_album_evento = $request->evento_id_album_evento;
                    $f->save();
                }
            } else {
                return redirect()->route('fotoestudio.index')->with('error', 'Error NO se subio ninguna foto');
            }

            // actualizar el estado del album a 1: fotos cargadas
            $album_evento = album_evento::where('id', '=', $request->evento_id_album_evento)->first();
            $album_evento->estado = 1;  // 0: sin fotos | 1: fotos cargadas | 2: fotos aprobadas
            $album_evento->save();

            //liberar al fotografo poner su estado en 0: disponible
            $fotografo = User::where('id', $request->evento_id_fotoestudio)->first();
            $fotografo->estado = 0; // 0: disponible | 1: ocupado
            $fotografo->save();

            return redirect()->route('fotoestudio.index')->with('success', 'Fotos subidas correctamente');
        } else {
            return redirect()->route('fotoestudio.index')->with('error', 'Error intentelo nuevamente');
        }
    }


    // Fotografo Show en desuso
    public function show(fotoestudio $fotoestudio)
    {
        dd($fotoestudio);
    }


    // Fotografo Edit en desuso
    public function edit(fotoestudio $fotoestudio)
    {
        dd($fotoestudio);
    }


    // Fotografo Update en desuso
    public function update(Request $request, fotoestudio $fotoestudio)
    {
        //
    }


    // Fotografo Destroy en desuso
    public function destroy(fotoestudio $fotoestudio)
    {
        //
    }
    public function reportes()
    {
        return view('VistaReportes.fotoestudio');
    }

    // funcion en desuso
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
}
