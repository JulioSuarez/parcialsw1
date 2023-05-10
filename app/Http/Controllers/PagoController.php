<?php

namespace App\Http\Controllers;

use App\Models\pago;
use App\Models\User;
use App\Models\planes;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('VistaPagos.index');
    }
    public function suscripcion2()
    {
        return view('VistaSuscripcion.suscripcion');
    }
    public function suscripcionPagada()
    {
        return view('VistaSuscripcion.felicidades');
    }
    public function suscripcionFallida()
    {
        return view('VistaSuscripcion.fallida');
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
        if ($request->hasFile('comprobante')) {
            $file = $request->file('comprobante');
            $destino = 'img/fotosClientes/';
            $comprobante = time() . '-' . $file->getClientOriginalName();
            $subirImagen = $request->file('comprobante')->move($destino, $comprobante);
        } else {
            $comprobante = "default.png";
        }

        $id = auth()->user()->id;
        $plan = planes::where('id_cliente','=',$id)->first();

        $pago = new pago();
        $pago->fecha = now();
        $pago->monto = $plan->precio;
        $pago->comprobante = $comprobante;
        $pago->save();

        if ($plan->tipo_plan < 3) {
            $rol = 4;   //fotoestudio
        }else{
            $rol = 3;   //organizador
        }

        $id = auth()->user()->id;
        $user = User::where('id', $id)->first();
        $user->syncRoles($rol);
        $user->save();


        if ($rol == 3) {
            return redirect()->route('organizadores.index');
        }else{
            return redirect()->route('fotoestudio.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pago $pago)
    {
        //
    }
}
