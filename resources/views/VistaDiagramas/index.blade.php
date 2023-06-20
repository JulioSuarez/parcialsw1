@extends('index')

@section('encabezado')
@endsection

@section('jcst')
    @if (session('success'))
        <div class="bg-green-500 text-white text-center animate-bounce" x-data="{ show: true }" x-show="show"
            x-init="setTimeout(() => show = false, 5000)">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col justify-center items-center">
        <h1 class="text-3xl font-bold mb-4">Mis Diagramas</h1>
        <div class="text-right w-full">
            <form action="{{ route('diagramas.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="flex justify-center mb-8">
                    <input type="text" name="titulo" placeholder="Nombre del Diagrama" required
                        class="border border-gray-300 px-4 py-2 rounded-l-md w-64">
                    <button class="bg-green-500 text-white px-4 py-2 rounded-r-md">Crear</button>
                </div>
            </form>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="text-left py-2 px-4 border-b">Título</th>
                        <th class="text-left py-2 px-4 border-b">Colaboradores</th>
                        <th class="text-center py-2 px-4 border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($diagramas as $d)
                        {{-- @dd($d['id']) --}}
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $d->titulo }}</td>

                            <td class="py-2 px-4 border-b">
                                @forelse ($invitados as $i)
                                    @if ($i->id_diagrama == $d->id)
                                        {{ $i->user_email }} |
                                    @endif
                                @empty
                                    No hay invitados
                                @endforelse
                            </td>

                            {{-- <td class="py-2 px-4 border-b">{{ $d['titulo'] }}</td> --}}
                            {{-- <td class="py-2 px-4 border-b">{{ $d['invitado'] }}</td> --}}
                            <td class="text-center py-2 px-4 border-b grid grid-cols-3">
                                {{-- <button class="text-green-500 hover:underline mr-2">Invitar</button>
                                <button class="text-blue-500 hover:underline mr-2">Editar</button>
                                <button class="text-red-500 hover:underline">Eliminar</button> --}}
                                <form id="invitacion" action="{{ route('invitados.create') }}" method="POST"
                                    class="inline">
                                    @csrf
                                    {{-- @dd($d) --}}
                                    <input id="invitacion" type="text" hidden name="id_diagrama"
                                        value="{{ $d->id }}">
                                    {{-- <input id="invitacion" type="text" hidden name="propietario"
                                        value="{{ $d->id_propietario }}">
                                    <input id="invitacion" type="text" hidden name="diagrama_name"
                                        value="{{ $d->titulo }}"> --}}
                                    <button id="invitacion" type="submit"
                                        class="text-green-500 hover:underline mr-2">Invitar</button>
                                </form>

                                <form id="editDiagrama" action="{{ route('diagramador') }}" method="post" class="inline">
                                    @csrf
                                    <input id="editDiagrama" type="text" hidden name="id_diagrama"
                                        value="{{ $d->id }}">
                                    <input id="editDiagrama" type="text" hidden name="titulo"
                                        value="{{ $d->titulo }}">
                                    <input id="editDiagrama" type="text" hidden name="propietario"
                                        value="{{ $d->id_propietario }}">
                                    <button id="editDiagrama" type="submit"
                                        class="text-blue-500 hover:underline mr-2">Editar</button>
                                </form>

                                <form id="deletDiagrama" action="{{ route('diagramas.destroy', $d->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <input id="deletDiagrama" type="text" hidden name="id_diagrama"
                                        value="{{ $d->id }}">
                                    <button id="deletDiagrama" type="submit"
                                        class="text-red-500 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-2 px-4 border-b">Diagrama 1</td>
                            <td class="py-2 px-4 border-b">Usuario 1, Usuario 2</td>
                            <td class="text-center py-2 px-4 border-b">
                                <button class="text-green-500 hover:underline mr-2">Invitar</button>
                                <button class="text-blue-500 hover:underline mr-2">Editar</button>
                                <button class="text-red-500 hover:underline">Eliminar</button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('scripts')
@endsection
