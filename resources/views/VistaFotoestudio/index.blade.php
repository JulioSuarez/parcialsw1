@extends('index')

@section('jcst')
    {{-- boton subir fotos --}}
    <h2 class="text-center">
        crear album de fotos de un evento
    </h2>
    <div class="flex justify-center">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
            <a href="{{ route('foto.create') }}">Subir fotos</a>
        </button>
    </div>


    <h2 class="text-center">
        Comparar las fotos que subi con las fotos de los perfiles de los clientes
    </h2>

    <div class="flex justify-center">

        <form action="{{ route('compararFotos') }}" method="get" enctype="multipart/form-data" class="max-w-md mx-auto">
            @csrf
            <div class="mb-4">
                <label for="imagenes" class="block text-gray-700 font-bold mb-2 hidden">por aqui estoy mandando una variable
                    ya cargada</label>
                <input class="hidden" name="xD" value="{{$fotoSubida}}">
            </div>
            <div class="flex items-center justify-between">

                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                    {{-- <a href="{{ route('compararFotos') }}">Activar IA</a> --}}
                    <span>Activar IA</span>
                </button>
            </div>
        </form>

    </div>
    <h2 class="text-center">
        ofertar las fotos
    </h2>
@endsection
