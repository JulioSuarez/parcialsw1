<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\fotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Evento;
use App\Models\similitud;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $id = auth()->user()->id;

        $fotos = similitud::join('fotos','fotos.id','=','similituds.id_foto')
        ->where('id_usuario', '=', $id)
        ->where('similituds.estado', '=', '0')
        ->join('eventos','eventos.id','=','fotos.id_evento')
        ->select('fotos.id as id','fotos.foto_renderizada',
        'fotos.id_evento as id_evento','eventos.evento_name',
        'similituds.id as id_similitud','similituds.estado')->get();

        // dd($fotos);

        return view('VistaCliente.facebook',compact('fotos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authController = new AuthenticatedSessionController();
        $usuario = $authController->dashboard();

        $clientes = User::get();

        return view('VistaCliente.create', compact('usuario','clientes'));
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
        $u->profile_photo_path = $foto_perfil;
        $u->portada_photo_path = $foto_portada;
        $u->save();
        $id_user = User::where('name', $u->name)->first();
        // dd($id_user->id);
        // $c = new cliente();
        // $c->foto_perfil = $foto_perfil;
        // $c->foto_portada = $foto_portada;
        // $c->telefono = $request->telefono;
        // $c->id_plan = 1;
        // $c->user_id = $id_user->id;

        // $c->save();
        // dd($c);

        return redirect()->route('Cliente.index');
    }

    /**
     * Display the specified resource.
     */

    public function apiJS($id)
    {
        // $id = auth()->user()->id;
        $usuario = User::where('id', '=', $id)->first();
        // $usuario = User::all();

        return json_encode($usuario->name, JSON_NUMERIC_CHECK);
    }
}
