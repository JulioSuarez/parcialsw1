<?php

namespace App\Http\Controllers;

use App\Models\diagrama;
use App\Models\User;
use App\Models\clase;
use App\Models\atributo;
use App\Models\invitado;
use App\Models\sintaxi;
use App\Models\relation;
use App\Models\relation_tipo;
use App\Models\tipo_dato;

use Illuminate\Http\Request;

class DiagramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = auth()->user()->id;
        $diagramas = Diagrama::where('id_propietario', $id)->orderBy('id', 'desc')->get();
        $invitados = invitado::get();
        // $coleccion = collect([]);
        // $invitadosArray = collect([]);
        // foreach ($diagramas as $diagrama) {
        //     $invitado = Invitado::where('id_diagrama', $diagrama->id)->get();
        //     if ($invitado) {
        //         foreach ($invitado as $inv) {
        //             $invitadosArray->push($inv->user_email);
        //         }
        //         // dd($invitadosArray);
        //         $coleccion->push([
        //             'id' => $diagrama->id,
        //             'titulo' => $diagrama->titulo,
        //             'invitados' => $invitadosArray,
        //             'fecha' => $diagrama->created_at,
        //         ]);
        //         // dd($coleccion);
        //     } else {
        //         $coleccion->push([
        //             'id' => $diagrama->id,
        //             'titulo' => $diagrama->titulo,
        //             'invitado' => 'No hay invitados',
        //             'fecha' => $diagrama->created_at,
        //         ]);
        //     }
        // }
        // dd($coleccion);
        return view('VistaDiagramas.index', compact('invitados', 'diagramas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request);
        $id = auth()->user()->id;
        // // $d = diagrama::where('titulo', $request->titulo)->where('id_propietario', $id)->order('id', 'desc')->first();
        $d = diagrama::where('id_propietario', $id)->latest()->first();
        $clases = clase::where('id_diagrama', $d->id)->get();
        $tipod = tipo_dato::get();
        return view('VistaDiagramas.dojs',compact('d', 'clases', 'tipod'));

        // return $this->diagramador($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $id = auth()->user()->id;
        $diagrama = new diagrama();
        $diagrama->titulo = $request->titulo;
        $diagrama->id_propietario = $id;
        $diagrama->save();

        // $d = diagrama::where('titulo', $request->titulo)->where('id_propietario', $id)->first();
        $d = diagrama::where('id_propietario', $id)->latest()->first();

        return redirect()->route('diagramas.create', ['diagrama' => $d]);

        // return redirect()->route('diagramas.create');

    }

    /**
     * Display the specified resource.
     */
    public function show(diagrama $d)
    {
        //
    }

    public function diagramador(Request $request){

        // dd($request);
        $d = diagrama::where('id', $request->id_diagrama)->first();
        // ->where('id_propietario', $request->propietario)->orderby('id', 'desc')->first();

        $tipod = tipo_dato::get();

        $clases = clase::where('id_diagrama', $d->id)->get();

        return view('VistaDiagramas.dojs',compact('d','tipod','clases'));
    }
    public function edit(Request $request)
    {
        // dd($request);
        $tipod = tipo_dato::get();
        $d = diagrama::where('titulo', $request->titulo)->where('id_propietario', $id)->order('id', 'desc')->first();
        return view('VistaDiagramas.dojs',compact('tipod','d'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, diagrama $d)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(diagrama $d, Request $request)
    {
        // dd($request);
        $diagrama = Diagrama::find($request->id_diagrama);
        // dd($diagrama);
        $diagrama->delete();
        return redirect()->route('diagramas.index');
    }

    public function storeClase(Request $request)
    {
        $clase = new clase();
        $clase->nombre = $request->nombre;
        $clase->diagrama_id = $request->diagrama_id;
        $clase->save();

        if ($clase) {
            return response()->json([
                'success' => true,
                'message' => 'Clase creada correctamente',
                // 'nombre' => $clase->nombre,
                // 'id' => $clase->id,
            ]);
        }
        return response()->json('Error al crear la clase');
    }

    public function storeAtributos(Request $request)
    {
        $atributo = new atributo();
        $atributo->nombre = $request->nombre;
        $atributo->tipo_dato_id = $request->tipo_dato_id;
        $atributo->clase_id = $request->clase_id;
        $atributo->save();

        if ($atributo) {
            return response()->json([
                'success' => true,
                'message' => 'Atributo creado correctamente',
                // 'nombre' => $atributo->nombre,
                // 'id' => $atributo->id,
            ]);
        }
        return response()->json('Error al crear el atributo');
    }
}
