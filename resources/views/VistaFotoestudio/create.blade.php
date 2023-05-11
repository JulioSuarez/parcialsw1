@extends('index')

@section('jcst')
    {{-- boton subir fotos --}}
    <form action="{{ route('subir.fotos.store') }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto">
        @csrf
        <div class="mb-4">
            <label for="imagenes" class="block text-gray-700 font-bold mb-2">Seleccionar imágenes:</label>
            <input type="file" name="imagenes[]" id="imagenes" multiple
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div>
            <input type="hidden" name="evento_id" value="{{$a->id}}">
            <input type="hidden" name="evento_name" value="{{$a->evento_name}}">
            <input type="hidden" name="evento_descripcion" value="{{$a->descripcion}}">
            <input type="hidden" name="evento_fecha" value="{{$a->fecha}}">
            <input type="hidden" name="evento_hora" value="{{$a->hora}}">
            <input type="hidden" name="evento_horafin" value="{{$a->horafin}}">
            <input type="hidden" name="evento_lugar" value="{{$a->lugar}}">
            <input type="hidden" name="evento_foto" value="{{$a->foto}}">
            <input type="hidden" name="evento_estado" value="{{$a->estado}}">
            <input type="hidden" name="evento_id_organizador" value="{{$a->id_organizador}}">
            <input type="hidden" name="evento_id_fotoestudio" value="{{$a->id_fotoestudio}}">
            <input type="hidden" name="evento_id_album_evento" value="{{$a->id_album_evento}}">
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                Subir fotos
            </button>
        </div>
    </form>
@endsection
