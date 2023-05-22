<?php

namespace App\Http\Controllers;

use App\Models\fotos;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart()
    {
        // Obtener los productos en el carrito desde la sesión o una base de datos
        $cartItems = session()->get('cart', []);
        // dd($cartItems);
        $fotos = fotos::join('eventos', 'eventos.id', '=', 'fotos.id_evento')->get();
        return view('VistaCliente.carito', compact('cartItems','fotos'));
    }

    public function addToCart(Request $request)
    {
        // dd($request);
        $foto = fotos::join('eventos', 'eventos.id', '=', 'fotos.id_evento')
        ->where('fotos.id','=',$request->foto_id)
        ->select('fotos.*','eventos.evento_name')->first();

        // Obtener los productos en el carrito desde la sesión
        $cartItems = session()->get('cart', []);
        // Verificar si el producto ya está en el carrito
        if (isset($cartItems[$foto->id])) {
            // Actualizar la cantidad del producto existente
            $cartItems[$foto->id]['quantity'] += $request->quantity;
        } else {
            // Agregar un nuevo producto al carrito
            $cartItems[$foto->id] = [
                'xd' => $request->foto_id,
                'name' => $foto->evento_name,
                'foto' => $foto->foto_renderizada,
                'price' => '10',
                'quantity' => $request->quantity
            ];
        }

        // Guardar los productos actualizados en el carrito en la sesión
        session()->put('cart', $cartItems);

        return redirect()->route('cart.show')->with('success', 'Producto agregado al carrito.');
    }

    public function removeFromCart(Request $request)
    {
        // dd($request);
        // Validar los datos recibidos del formulario de eliminar del carrito
        // $request->validate([
        //     'foto_id' => 'required|exists:fotos,id'
        // ]);

        // Obtener los productos en el carrito desde la sesión
        $cartItems = session()->get('cart', []);

        // Eliminar el producto del carrito
        unset($cartItems[$request->foto_id]);

        // Guardar los productos actualizados en el carrito en la sesión
        session()->put('cart', $cartItems);

        return redirect()->route('cart.show')->with('success', 'Producto eliminado del carrito.');
    }

    public function updateCart(Request $request)
    {
        // dd($request);
        // Validar los datos recibidos del formulario de actualizar el carrito
        $request->validate([
            'foto_id' => 'required|exists:fotos,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Obtener los productos en el carrito desde la sesión
        $cartItems = session()->get('cart', []);

        // Actualizar la cantidad del producto en el carrito
        $cartItems[$request->foto_id]['quantity'] = $request->quantity;

        // Guardar los productos actualizados en el carrito en la sesión
        session()->put('cart', $cartItems);

        return redirect()->route('cart.show')->with('success', 'Carrito actualizado.');
    }
}
