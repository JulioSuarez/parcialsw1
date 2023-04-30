<?php

namespace App\Http\Controllers;

use App\Models\fotoestudio;
use Illuminate\Http\Request;
use Aws\Exception\AwsException;
use Aws\Rekognition\RekognitionClient;

class FotoestudioController extends Controller
{

    public function compararFotos($fotoSubida, $fotoAlmacenada)
    {
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
        //
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
        //
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
