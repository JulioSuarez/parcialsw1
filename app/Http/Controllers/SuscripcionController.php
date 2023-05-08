<?php

namespace App\Http\Controllers;

use App\Models\orden_pago;
use App\Models\pago;
use App\Models\suscripcion;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SuscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('VistaSuscripcion.index');
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
    public function store(Request $r)
    {
        // $op = new orden_pago();
        // $op->monto = $r->monto_op;
        // $op->descripcion = $r->descripcion;
        // $op->estado = $r->estado;
        // $op->fecha_limite = $r->fecha_limite;
        // $op->metodo = $r->metodo;

        // $p = new pago();
        // $p->fecha = now();
        // $p->monto = $r->monto_p;
        // $p->comprobante = $comprobante;
        // $p->
        // $p->save();


        // // dd($r);
        // $roles = $r->input('roles', []);
        // $id = auth()->user()->id;
        // $user = User::where('id', $id)->first();
        // $user->syncRoles($roles);
        // $user->save();

        // $s = new suscripcion();
        // $s->fecha_inicio = $r->fecha_inicio;
        // $s->fecha_fin = $r->fecha_fin;
        // $s->estado = $r->estado;
        // $s->plan = $r->plan;
        // $s->id_usuario = $id;
        // $s->save();

        // $roles = $r->input('roles', []);
        // $id = auth()->user()->id;
        // $user->syncRoles($roles);
    }

    /**
     * Display the specified resource.
     */
    public function show(suscripcion $suscripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(suscripcion $suscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, suscripcion $suscripcion)
    {
                // dd($r);
                $roles = $r->input('roles', []);
                $id = auth()->user()->id;
                $user = User::where('id', $id)->first();
                $user->syncRoles($roles);
                $user->save();





                $s = $suscripcion;
                $s->fecha_inicio = $r->fecha_inicio;
                $s->fecha_fin = $r->fecha_fin;
                $s->estado = $r->estado;
                $s->plan = $r->plan;
                $s->id_orden_pago = $r->id_orden_pago;
                $s->id_usuario = $id;
                $s->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(suscripcion $suscripcion)
    {
        //
    }
}
