<?php

namespace App\Http\Controllers;

use App\Models\album_foto;
use App\Models\cliente;
use App\Models\fotoestudio;
use App\Models\fotos;
use App\Models\User;
use Illuminate\Http\Request;
use Aws\Rekognition\RekognitionClient;
use Aws\Exception\AwsException;

class FotoestudioController extends Controller
{

    public function compararFotos(Request $request)
    {


        //aqui tengo las fotos de perfil de todos mis clientes
        $fotoAlmacenada = cliente::get();
        $len = count($fotoAlmacenada);
        dd($len);
        for ($i = 0; $i < $len; $i++) {
            // hacer algo xD
        }




        $fotoSubida = album_foto::get();
        $len = count($fotoSubida);
        dd($len);
        for ($i = 0; $i < $len; $i++) {
            // vamos a recorrer cada una de las fotos que subimos


            //aqui adentro are otro for que recorra la tabla clientes y que me muestre solo el atributo foto de perfil
            $fotoAlmacenada = cliente::get();
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


        $fotoSubida = album_foto::get();
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
        $fotoSubida = cliente::get();
        // foreach ($fotoSubida as $foto) {
        //     $fotoSubida = $foto->foto_perfil;
        //     dd($fotoSubida);
        // }
        return view('VistaFotoestudio.index', compact('fotoSubida'));
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
        dd($request);
        return redirect()->route('fotoestudio.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(fotoestudio $fotoestudio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fotoestudio $fotoestudio)
    {
        //
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
}
