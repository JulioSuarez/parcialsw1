<?php

namespace App\Http\Controllers;

use App\Models\atributo;
use App\Models\clase;
use App\Models\relation;
use App\Models\tipo_dato;
use Illuminate\Http\Request;


use Kreait\Firebase\Contract\Database;
use Kreait\Laravel\Firebase\Facades\Firebase;


class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        // dd($request);
        $clase = new clase();
        $clase->name = $request->nombre;
        $clase->id_diagrama = $request->id_diagrama;
        $clase->save();

        $c = clase::where('name', $request->nombre)->where('id_diagrama', $request->id_diagrama)->orderBy('id', 'desc')->first();
        $td = tipo_dato::where('name', '=', $request->tipo)->first();

        $atributo = new atributo();
        $atributo->name = 'id';
        $atributo->clase_id = $c->id;
        $atributo->tipo_id = $td->id;
        $atributo->save();

        $a = atributo::where('name', '=', 'id')->where('clase_id', '=', $c->id)->orderBy('id', 'desc')->first();

        $database = app(Database::class);
        $reference = $database->getReference('clases');
        $reference->push([
            'id' => $c->id,
            'name' => $c->name,
            'id_diagrama' => $c->id_diagrama,
        ]);

        $database = app(Database::class);
        $reference = $database->getReference('atributos');
        $reference->push([
            'id' => $a->id,
            'name' => $a->name,
            'tipo_id' => $a->tipo_id,
            'clase_id' => $a->clase_id,
        ]);


        if ($clase) {
            return response()->json([
                'success' => true,
                'message' => 'Clase creada correctamente',
                'nombre' => $request->nombre,
                'clase id' => $c->id,
            ]);
        }
        return response()->json('Error al crear la clase');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $clase = clase::where('id', '=', $request->idClase)->first();
        $clase->name = $request->NuevoNombre;
        $clase->save();
        if ($clase) {
            return response()->json([
                'success' => true,
                'message' => 'NUEVO NOMBRE ACTIALIZADO',
                'id de la Clase' => $request->idClase,
                'Nuevo Nombre de la Clase' => $request->NuevoNombre,
            ]);
        }
        return response()->json('Error al actualizar el nombre de la clase');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /////////////////////////////////////////////SECCION DE ATRIBUTOS
    public function atributos()
    {
        return view('VistaDiagramas.atributos');
    }

    public function atributoStore(Request $request)
    {

        $a = new atributo();
        $a->name = $request->name;
        $a->clase_id = $request->id_clase;
        $a->tipo_id = $request->tipoDeDato;
        $a->save();


        if ($a) {
            return response()->json([
                'success' => true,
                'message' => 'Clase creada correctamente',
                'Atributo-name' => $request->name,
                'Atributo-name' => $request->formato,
                'id_clase' => $request->id_clase,
            ]);
        }
        return response()->json('Error al crear la clase');
    }
    public function atributoDestroy(atributo $a)
    {

        $a->delete();
        if ($a) {
            return response()->json([
                'success' => true,
                'message' => 'Atributo Eliminado correctamente',
            ]);
        }
        return response()->json('Error al Eliminar el Atributo');
    }
    public function atributoUpdate(Request $request, atributo $a)
    {

        $at = atributo::where('id', '=', $a->id)->first();
        $at->name = $request->name;
        // $at->clase_id = $request->id_clase;
        $at->save();

        if ($a) {
            return response()->json([
                'success' => true,
                'message' => 'Atributo editado correctamente',
                'Atributo-name' => $request->name,
                'id_clase' => $request->id_clase,
            ]);
        }
        return response()->json('Error al editar el Atributo');
    }
    /////////////////////////////////////////////FIN SECCION ATRIBUTOS


    /////////////////////////////////////////////SECCION DE RELACIONES
    public function relacionStore(Request $request)
    {
        $relacion = new relation();
        $relacion->clase_origen = $request->claseOrigen;
        $relacion->clase_destino = $request->claseDestino;
        $relacion->tipo_relacion = $request->tipoRelacion;
        $relacion->save();

        if ($relacion) {
            return response()->json([
                'success' => true,
                'message' => 'Relacion creada correctamente',
                'Origen' => $request->claseOrigen,
                'Destino' => $request->claseDestino,
                'relacion' => $request->tipoRelacion,
            ]);
        }
        return response()->json('Error al crear la relacion');
    }

    public function relacionUpdate(Request $request, relation $r)
    {
        $relacion = relation::where('id', '=', $r->id)->first();
        $relacion->clase_origen = $request->idClaseOrigen;
        $relacion->clase_destino = $request->idClaseDestino;
        $relacion->tipo_relacion = $request->tipoRelacion;
        $relacion->save();

        if ($relacion) {
            return response()->json([
                'success' => true,
                'message' => 'Relacion creada correctamente',
                'Origen' => $request->claseOrigen,
                'Destino' => $request->claseDestino,
                'relacion' => $request->tipoRelacion,
            ]);
        }
        return response()->json('Error al actualizar la relacion');
    }

    public function relacionDestroy(Request $r)
    {
        $relacion = relation::where('clase_origen', '=', $r->idClaseOrigen)
        ->where('clase_destino','=',$r->idClaseDestino)
        ->first();
        // ->where('tipo_relacion','=',$r->tipoRelacion)
        $relacion->delete();

        if ($relacion) {
            return response()->json([
                'success' => true,
                'message' => 'Relacion Eliminada correctamente',
            ]);
        }
        return response()->json('Error al Eliminar la relacion');
    }
}
