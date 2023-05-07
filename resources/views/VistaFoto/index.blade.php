@extends('index')

@section('jcst')
    {{-- boton subir fotos --}}
    <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto">
        @csrf
        <div class="mb-4">
            <label for="imagenes" class="block text-gray-700 font-bold mb-2">Seleccionar imágenes:</label>
            <input type="file" name="imagenes[]" id="imagenes" multiple
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md"
                type="submit">
                Subir fotos
            </button>
        </div>
    </form>
@endsection
