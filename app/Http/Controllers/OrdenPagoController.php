<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\orden_pago;
use Illuminate\Http\Request;

class OrdenPagoController extends Controller
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

        $id = auth()->user()->id;
        $user = User::where('id', $id)->first();
        $user->syncRoles(6);
        $user->save();

        $op = new orden_pago();
        $op->monto = $request->monto;
        $op->fecha_limite = $request->fecha_limite;
        $op->descripcion = $request->descripcion;
        $op->estado = $request->estado;
        $op->metodo = $request->metodo;
        $op->save();

        return redirect()->route('suscripcion.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(orden_pago $orden_pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(orden_pago $orden_pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, orden_pago $orden_pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(orden_pago $orden_pago)
    {
        //
    }
}
