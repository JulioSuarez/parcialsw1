<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\User;
use Illuminate\Http\Request;

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

        dd($request);
        $u = new User();
        $u->name = $request->name;
        $u->email = $request->email;
        $u->fecha_nacimiento = $request->fecha_nacimiento;
        $u->genero = $request->genero;
        $u->password = $request->password;
        $u->save();
        $c = new cliente();
        $c->foto_perfil = $request->file('foto_perfil');
        $c->foto_portada = $request->file('foto_portada');


        $c->telefono = $request->telefono;
        $c->user_id = $u->id;
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
