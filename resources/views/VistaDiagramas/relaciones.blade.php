@extends('index');

@section('encabezado')
@endsection

@section('jcst')
    <div class="container mx-auto p-4">
        <!-- Contenedor de la tabla -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Tabla de Tipo de Relaciones</h2>
            <table class="w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Tipo de relación</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($relaciones as $r)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $r->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $r->name }}</td>
                        </tr>
                    @empty
                        <!-- Aquí deberías iterar sobre los datos de las relaciones para mostrar las filas -->
                        <tr>
                            <td class="py-2 px-4 border-b">1</td>
                            <td class="py-2 px-4 border-b">Relación 1</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b">2</td>
                            <td class="py-2 px-4 border-b">Relación 2</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Contenedor del formulario -->
        <div>
            <h2 class="text-2xl font-bold mb-4">Crear nuevo Tipo de relación</h2>
            <form action="{{ route('relaciones.store') }}" method="POST" class="w-full max-w-sm">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700">Nombre de la relación</label>
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
