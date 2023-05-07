@extends('index')

@section('jcst')
<div class="w-full px-6 mx-auto">
        <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover min-h-75 rounded-2xl">
            <img src="{{ asset('img/fotosClientes/' . $usuario->foto_portada) }}" alt=""
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; object-position: top;">
        </div>

        <div
            class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-auto max-w-full px-3">
                    <div
                        class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">
                        <img src="{{ asset('img/fotosClientes/' . $usuario->foto_perfil) }}" alt="profile_image"
                            class="w-full shadow-soft-sm rounded-xl" />
                    </div>
                </div>
                <div class="flex-none w-auto max-w-full px-3 my-auto">
                    <div class="h-full">
                        <h5 class="mb-1">@auth
                                {{ auth()->user()->name }}
                            @else
                                {{ 'Nombre de Usuario' }}
                            @endauth
                        </h5>
                        <p class="mb-0 font-semibold leading-normal text-sm">@auth
                                {{ auth()->user()->email }}
                            @else
                                {{ 'Correo de Usuario' }}
                            @endauth
                        </p>
                    </div>
                </div>
                <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                    <div class="relative right-0">
                        <ul class="relative flex flex-wrap p-1 list-none bg-transparent rounded-xl" nav-pills
                            role="tablist">
                            <li class="z-30 flex-auto text-center">
                                <a class="block w-full px-0 py-1 mb-0 transition-all border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700"
                                    nav-link href="#" role="tab" aria-selected="true">

                                    <span class="ml-1">News</span>
                                </a>
                            </li>
                            <li class="z-30 flex-auto text-center">
                                <a class="z-30 block w-full px-0 py-1 mb-0 transition-all border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700"
                                    nav-link href="#" role="tab" aria-selected="false">
                                    <span class="ml-1">Album</span>
                                </a>
                            </li>
                            <li class="z-30 flex-auto text-center">
                                <a class="z-30 block w-full px-0 py-1 mb-0 transition-colors border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700"
                                    nav-link href="#" role="tab" aria-selected="false">
                                    <span class="ml-1">Invitaciones</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <div class="my-2 bg-white dark:bg-gray-900 rounded-xl">
        {{-- @include('VistaCliente.planes') --}}
    </div>
@endsection
