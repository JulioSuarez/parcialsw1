@extends('index')

@section('jcst')
    {{-- titulo centrado --}}
    <div class="my-6 flex justify-center">
        <h1 class="text-3xl text-gray-900 dark:text-gray-100">Crear Evento</h1>
    </div>


    <form action="{{ route('organizadores.store') }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto">
        @csrf
        <div class="mb-4">
            <label for="evento_name" class="block text-gray-700 font-bold mb-2">Nombre del evento:</label>
            <input type="text" name="evento_name" id="evento_name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="3"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>
        <div class="mb-4">
            <label for="fecha" class="block text-gray-700 font-bold mb-2">Fecha:</label>
            <input type="date" name="fecha" id="fecha"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="hora" class="block text-gray-700 font-bold mb-2">Hora:</label>
            <input type="time" name="hora" id="hora"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="horafin" class="block text-gray-700 font-bold mb-2">Hora de Finalizacion:</label>
            <input type="time" name="horafin" id="horafin"
            value="23:59" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="lugar" class="block text-gray-700 font-bold mb-2">Lugar:</label>
            <input type="text" name="lugar" id="lugar"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        {{-- elegir al foto estudio --}}
        <div class="mb-4">
            <label for="lugar" class="block text-gray-700 font-bold mb-2">Estudios Fotograficos Disponibles:</label>
            <select name="fotoestudio"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Selecciona un Foto Estudio</option>
                @foreach ($fotoestudios as $foto)
                    @if ($foto->hasRole('fotoestudio'))
                        @if ($foto->estado == 1)
                            <option value="" disabled>{{ $foto->name }} (No disponible)</option>
                        @else
                            <option value="{{ $foto->id }}">{{ $foto->name }}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="foto" class="block text-gray-700 font-bold mb-2">Foto:</label>
            <input type="file" name="foto" id="foto"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Registrar evento
            </button>

        </div>
    </form>
@endsection
