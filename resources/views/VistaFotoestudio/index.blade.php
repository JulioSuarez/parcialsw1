@extends('index')

@section('jcst')
    {{-- boton subir fotos --}}
    {{-- <h2 class="text-center">
        crear album de fotos de un evento
    </h2> --}}

    {{-- @php
        // crear esta opcion en una lista de eventos en el index del fotoestudio (eventos donde trabajo el fotografo)
        use App\Models\Evento;
        $id = auth()->user()->id;
        $habilitado = Evento::where('id_fotoestudio', '=', $id)
            ->latest()
            ->first();
        // dd($habilitado);
    @endphp
    @if (!is_null($habilitado))
        <div class="flex justify-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                <a href="{{ route('subir.fotos') }}">Subir fotos</a>
            </button>
        </div>
    @else
        <div class="flex justify-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                <a href="#">NO Subir fotos</a>
            </button>
        </div>
    @endif --}}



    {{-- lista de eventos asignados --}}

    {{--
    <div class="flex justify-center">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
            <a href="{{ route('subir.fotos') }}">Subir fotos</a>
        </button>
    </div> --}}







    @if ($errors->has('error'))
        <div class="error text-red-500 text-center animate-bounce" x-data="{ show: true }" x-show="show"
            x-init="setTimeout(() => show = false, 5000)">
            {{ $errors->first('error') }}
        </div>
    @endif


    @if ( session('success'))
        <div class="bg-green-500 text-white text-center animate-bounce" x-data="{ show: true }" x-show="show"
            x-init="setTimeout(() => show = false, 5000)">
            {{ session('success') }}
        </div>
    @endif





    @if ($coleccion->isEmpty())
    @else
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6 class="text-red-600">Lista de Eventos</h6>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Evento</th>
                                        <th
                                            class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coleccion as $e)
                                        {{-- tengo una coleccion de id de todos los eventos que tengo asignado como fotografo --}}
                                        @foreach ($eventos as $evento)
                                            @if ($evento->id == $e)
                                                {{-- @dd($e) --}}
                                                {{-- true: me muestra la lista de los eventos asignados --}}
                                                <tr>
                                                    {{-- datos del evento --}}
                                                    <td
                                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                        <div class="flex px-2 py-1">
                                                            <div>
                                                                <img src="{{ asset('img/Eventos/' . $evento->foto) }}"
                                                                    class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                                    alt="user3" />
                                                            </div>
                                                            <div class="flex flex-col justify-center">
                                                                <h6 class="mb-0 leading-normal text-sm">
                                                                    {{ $evento->evento_name }}
                                                                </h6>
                                                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                                                    {{ $evento->descripcion }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- verifico si soy yo el asignado --}}
                                                    {{-- <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <div class="flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('img/fotosClientes/' . $evento->fotostudio_perfil) }}"
                                                            class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                            alt="user3" />
                                                    </div>
                                                    <div class="flex flex-col justify-center">
                                                        <h6 class="mb-0 leading-normal text-sm">{{ $evento->fotoestudio }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td> --}}

                                                    {{-- boton para subir las fotos de este evento, enviar el ID de este evento --}}
                                                    <td
                                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                        @if ($evento->estado == 0)
                                                            <div class="flex justify-center">
                                                                <button
                                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                                                                    {{-- <a href="{{ route('fotoestudio.edit',$evento->id) }}">Subir fotos</a> --}}
                                                                    <form action="{{ Route('subir.fotos', $evento->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="text" name="id" class="hidden"
                                                                            value="{{ $evento->id }}">
                                                                        <input type="submit" value="Subir fotos"
                                                                            class=""
                                                                            onclick="return confirm('Desea subir fotos del evento: {{ $evento->evento_name }}')">
                                                                    </form>
                                                                </button>
                                                            </div>
                                                        @else
                                                            <div class="flex justify-center">
                                                                <button
                                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md"
                                                                    disabled>
                                                                    <a href="#">No disponible Subir fotos</a>
                                                                </button>
                                                            </div>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

























    {{--
    <h2 class="text-center">
        Comparar las fotos que subi con las fotos de los perfiles de los clientes
    </h2>

    <div class="flex justify-center">

        <form action="{{ route('compararFotos') }}" method="get" enctype="multipart/form-data" class="max-w-md mx-auto">
            @csrf
            <div class="mb-4">
                <label for="imagenes" class="block text-gray-700 font-bold mb-2 hidden">por aqui estoy mandando una variable
                    ya cargada</label>
                <input class="hidden" name="xD" value="{{ $fotoSubida }}">
            </div>
            <div class="flex items-center justify-between">

                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">

                    <span>Activar IA</span>
                </button>
            </div>
        </form>

    </div>
    <h2 class="text-center">
        ofertar las fotos
    </h2> --}}
@endsection
