<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            // 'foto' => ['image','mimes:jpeg,png,jpg,gif,svg'],
        ]);

        if($request->hasFile('foto'))
            $fotoCliente = $request->file('foto')->store('public/cliente');

        $user = User::create([
            'id' => $request->id,
            'name' => $request->nombre,
            'email' => $request->email,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $reponse = [
            'user' => [
                'id' => $user->id,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'email' => $user->email,
                'telefono' => $user->telefono,
            ],
            'token' => $token,
        ];

        return response($reponse, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'massage' => 'Credenciales Incorectas'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => [
                'id' => $user->id,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'email' => $user->email,
                'telefono' => $user->telefono,
            ],
            'token' => $token
        ];

        return response($response, 201);  // Retornamos respuesta
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();  // Elimina token

        return [
            'message' => 'Logged Out'
        ];
    }


}
