<?php

namespace App\Http\Controllers;

use App\Models\diagrama;
use App\Models\invitado;
use Illuminate\Http\Request;
use App\Mail\CorreosMailable;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class InvitadoController extends Controller
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
    public function create(Request $request)
    {
        // dd($request);
        $diagrama = diagrama::Where('id','=',$request->id_diagrama)->first();
        // dd($diagrama);
        return view('VistaDiagramas.invitadoStore', compact('diagrama'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // marcoantorniocruzrojas@gmail.com
        $diagrama = diagrama::Where('id','=',$request->id_diagrama)->first();
        $propietario = User::Where('id','=',$diagrama->id_propietario)->first();

        $d = $diagrama->titulo;
        $p = $propietario->name;


        $invitados = explode(',', $request->input('invitados'));
        foreach ($invitados as $e) {
            // dd($e);
            $i = new invitado();
            $i->user_email = $e;
            $i->id_diagrama = $request->id_diagrama;
            $i->save();

            $correo = new CorreosMailable($d, $p, $e);
            Mail::to($e)->send($correo);
        }


        return redirect()->route('diagramas.index')->with('success', 'Invitaciones enviadas');
    }

    /**
     * Display the specified resource.
     */
    public function show(invitado $invitado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invitado $invitado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invitado $invitado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invitado $invitado)
    {
        //
    }
}
