<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('VistaCliente.index');
        // return view('template.profile');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('VistaCliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        if ($request->hasFile('foto_perfil')) {
            $file = $request->file('foto_perfil');
            $destino = 'img/fotosClientes/';
            $foto_perfil = time() . '-' . $file->getClientOriginalName();
            $subirImagen = $request->file('foto_perfil')->move($destino, $foto_perfil);
        } else {
            $foto = "default.png";
        }
        if ($request->hasFile('foto_portada')) {
            $file = $request->file('foto_portada');
            $destino = 'img/fotosClientes/';
            $foto_portada = time() . '-' . $file->getClientOriginalName();
            $subirImagen = $request->file('foto_portada')->move($destino, $foto_portada);
        } else {
            $foto = "default.png";
        }


        // dd($request);
        $u = new User();
        $u->name = $request->name;
        $u->email = $request->email;
        $u->fecha_nacimiento = $request->fecha_nacimiento;
        $u->genero = $request->genero;
        $u->password = Hash::make($request->password);

        $u->save();
        $c = new cliente();
        $c->foto_perfil = $foto_perfil;
        $c->foto_portada = $foto_portada;
        $c->telefono = $request->telefono;
        $c->id_plan = 1;
        $c->user_id = $u->id;

        // dd($c);
        $c->save();

        return redirect()->route('Cliente.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cliente $cliente)
    {
        //
    }
}
