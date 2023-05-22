@extends('index')

@section('jcst')

    <div class="flex flex-col items-center">
        <div>
            <h1>Carrito de compras</h1>
        </div>
        <div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (count($cartItems) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $productId => $item)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div>
                                            <img src="{{ $item['foto'] }}"
                                                class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                alt="foto" />
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item['price'] }}</td>

                                <td>
                                    <div class="grid grid-cols-1 gap-1">
                                        <form id="formulario1_{{ $productId }}" action="{{ route('cart.update') }}"
                                            method="POST">
                                            @csrf
                                            <div class="flex justify-center">
                                                <input type="hidden" name="foto_id" value="{{ $item['xd'] }}">
                                                <input class="rounded" type="number" name="quantity"
                                                    value="{{ $item['quantity'] }}" style="width: 50px;">
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $item['price'] * $item['quantity'] }}</td>
                                <td>
                                    <form id="formulario2_{{ $productId }}" action="{{ route('cart.remove') }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="foto_id" value="{{ $item['xd'] }}">
                                    </form>
                                </td>
                                <td>
                                    <div class="flex">
                                        <div class="flex justify-center mr-2">
                                            <button form="formulario1_{{ $productId }}" type="submit"><i class="fas fa-sync"></i></button>
                                        </div>
                                        <div class="flex justify-center ml-2">
                                            <button form="formulario2_{{ $productId }}" type="submit"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay productos en el carrito.</p>
            @endif
        </div>
    </div>

@endsection
