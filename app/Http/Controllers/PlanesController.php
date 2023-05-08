<?php

namespace App\Http\Controllers;

use App\Models\planes;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\orden_pago;
use Illuminate\Support\Facades\Auth;

class PlanesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planes = planes::all();
        return view('VistaPlanes.index', compact('planes'));
        // return view('VistaPlanes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('VistaPlanes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);
        $id = auth()->user()->id;
        $user = User::where('id', $id)->first();
        $user->syncRoles(5);
        $user->save();

        $p = new planes();
        $p->tipo_plan = $request->plan;
        switch ($request->plan) {
            case 1:
                $p->precio = 20;
                break;
            case 2:
                $p->precio = 100;
                break;
            case 3:
                $p->precio = 20;
                break;
            case 4:
                $p->precio = 100;
                break;
            default:
                $user->syncRoles(2);
                $user->save();
                return  redirect()->route('planes.index');
                break;
        }
        $p->id_cliente = $id;
        $p->save();

        $op = new orden_pago();
        $op->monto = $request->monto;
        $op->fecha_limite = $request->fecha_limite;
        $op->descripcion = $request->descripcion;
        $op->estado = $request->estado;
        $op->metodo = $request->metodo;
        $op->id_suscripcion = $p->id;
        $op->save();

        return redirect()->route('pago.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(planes $planes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(planes $planes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, planes $planes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(planes $planes)
    {
        //
    }
}
