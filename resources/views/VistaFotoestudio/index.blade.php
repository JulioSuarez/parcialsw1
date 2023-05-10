@extends('index')

@section('jcst')
    {{-- boton subir fotos --}}
    <h2 class="text-center">
        crear album de fotos de un evento
    </h2>

    @php
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
    @endif



    {{-- lista de eventos asignados --}}

    {{--
    <div class="flex justify-center">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
            <a href="{{ route('subir.fotos') }}">Subir fotos</a>
        </button>
    </div> --}}
















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
                                    @foreach ($colleccion as $e)
                                        {{-- tengo una coleccion de id de todos los eventos que tengo asignado como fotografo --}}
                                        @if ($evento->id == $e)
                                            {{-- true: me muestra la lista de los eventos asignados --}}
                                        @endif
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
                                                        <h6 class="mb-0 leading-normal text-sm">{{ $evento->evento_name }}
                                                        </h6>
                                                        <p class="mb-0 leading-tight text-xs text-slate-400">
                                                            {{ $evento->descripcion }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- verifico si soy yo el asignado --}}
                                            <td
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
                                            </td>
                                            {{-- boton para subir las fotos de este evento, enviar el ID de este evento --}}
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <a href="#"
                                                    class="font-semibold leading-tight text-xs text-slate-400">
                                                    <svg fill="none" stroke="currentColor" stroke-width="1.0"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


























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
