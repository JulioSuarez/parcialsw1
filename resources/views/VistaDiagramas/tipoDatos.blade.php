@extends('index');

@section('encabezado')
@endsection

@section('jcst')
    <div class="container mx-auto p-4">
        <!-- Contenedor de la tabla -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Tipos de Datos</h2>
            <table class="w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">#</th>
                        <th class="py-2 px-4 border-b">Tipo</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($td as $s)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $s->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $s->name }}</td>
                        </tr>
                    @empty
                        <!-- Aquí deberías iterar sobre los datos de los formatos para mostrar las filas -->
                        <tr>
                            <td class="py-2 px-4 border-b">1</td>
                            <td class="py-2 px-4 border-b">Tipo 1</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b">2</td>
                            <td class="py-2 px-4 border-b">Tipo 2</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Contenedor del formulario -->
        <div>
            <h2 class="text-2xl font-bold mb-4">Crear nuevo tipo</h2>
            <form action="{{ route('storeTipoDato') }}" method="POST" class="w-full max-w-sm">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700">Nombre del tipo de dato</label>
                    <input type="text" name="nombre" id="nombre" required
                        class="w-full border border-gray-300 px-4 py-2 rounded-md"
                        oninput="this.value = this.value.toUpperCase()">
                </div>
                <div class="text-left">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
