<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="./assets/img/favicon.png" />
    <title>Software 1 - JCST</title>
    {{-- para mis diagramas --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mermaid@8.14.0/dist/mermaid.css"> --}}
    {{-- segundo diagramador mxgraph --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('vendor/mxgraph/javascript/src/css/common.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('vendor/mxgraph/javascript/src/css/graph.css') }}"> --}}
    {{-- diagramador MXGRAPH --}}
    {{-- <script type="text/javascript" src="{{ asset('vendor/mxgraph/javascript/mxClient.js') }}"></script> --}}

    {{-- Fonts and icons --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    {{-- Font Awesome Icons --}}
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    {{-- <script src="https://unpkg.com/@popperjs/core@2"></script> --}}



    {{-- by julico --}}
    @yield('encabezado')



    {{-- RECURSOS xD --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/nucleo-icons.css', 'resources/css/nucleo-svg.css', 'resources/css/soft-ui-dashboard-tailwind.min.css', 'resources/css/soft-ui-dashboard-tailwind.css?v=1.0.4'])
    {{-- RECURSOS PARA PRODUCCION --}}
    {{--
     <link href="{{ asset('build/assets/app-8a8e309e.css') }}" rel="stylesheet" />
     <link href="{{ asset('build/assets/app-20106add.js') }}" rel="stylesheet" />
     <link href="{{ asset('build/manifest.json') }}" />
     --}}

    @livewireStyles()



    {{-- servidor socket --}}
    <script src="https://cdn.socket.io/4.6.0/socket.io.min.js"
        integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script type="importmap">
        {
            "imports": {
                "socket.io-client": "https://cdn.socket.io/4.3.2/socket.io.esm.min.js"
            }
        }
    </script>

    <script type="module">
        import {io} from 'socket.io-client';

        const socket = io("http://localhost:3000", {
            transports: ["websocket"]
        });

        const user_id = <?php echo auth()->user()->id; ?>;

        console.log('Hola usuario Nro:' + user_id);
        // EMITS

        socket.emit('saludo', user_id);

        socket.on('saludo_respuesta', (respuesta) => {
            console.log(respuesta);
        });

    </script>


</head>

<body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">

    <!-- sidenav  -->
    <aside
        class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
        <div class="h-19.5">
            <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
                sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="javascript:;" target="_blank">
                <img src="{{ asset('assets/img/JCST.png') }}"
                    class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8"
                    alt="main_logo" />
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">E-commerce Foto</span>
            </a>
        </div>

        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
        @include('nav')
    </aside>
    <!-- end sidenav -->


    {{-- barra de navegacion, notificacion y perfil --}}
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
            navbar-main navbar-scroll="true">
            <div class="flex items-center justify-end w-full px-4 py-1 mx-auto flex-wrap-inherit">

                <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">

                    <li class="flex items-center px-2">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-sm text-slate-500">
                            <i class="fa fa-user sm:mr-1"></i>
                            <span class="hidden sm:inline">Perfil Info</span>
                        </a>
                    </li>
                    <li class="flex items-center pl-4 xl:hidden px-2">
                        <a href="javascript:;" class="block p-0 transition-all ease-nav-brand text-sm text-slate-500"
                            sidenav-trigger>
                            <div class="w-4.5 overflow-hidden">
                                <i
                                    class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                <i
                                    class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            </div>
                        </a>
                    </li>
                    {{-- <li class="flex items-center px-4">
                        <a href="javascript:;" class="p-0 transition-all text-sm ease-nav-brand text-slate-500">
                            <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog"></i>
                            <!-- fixed-plugin-button-nav  -->
                        </a>
                    </li> --}}

                    <!-- notifications notifications notifications notifications notifications notifications notifications -->

                    <li class="relative flex items-center px-2">
                        <p class="hidden transform-dropdown-show"></p>
                        <a href="javascript:;" class="block p-0 transition-all text-sm ease-nav-brand text-slate-500"
                            dropdown-trigger aria-expanded="false">
                            <i class="cursor-pointer fa fa-bell"></i>
                        </a>

                        <ul dropdown-menu
                            class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease-soft lg:shadow-soft-3xl duration-250 min-w-44 before:sm:right-7.5 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
                            <!-- add show class on dropdown open js -->
                            <li class="relative mb-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors"
                                        href="javascript:;"
                                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                        <div class="flex py-1">
                                            {{-- <div class="my-auto">
                                            <img src="./assets/img/team-2.jpg"
                                                class="inline-flex items-center justify-center mr-4 text-white text-sm h-9 w-9 max-w-none rounded-xl" />
                                        </div> --}}
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-1 font-normal leading-normal text-sm"><span
                                                        class="font-semibold">Log Out</span></h6>
                                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                                    {{-- <i class="mr-1 fa fa-clock"></i> --}}

                                                </p>

                                                {{-- <p class="mb-0 leading-tight text-xs text-slate-400">
                                                <i class="mr-1 fa fa-clock"></i>
                                                13 minutes ago
                                            </p> --}}
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </li>
                            <li class="relative mb-2">
                                <a class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors"
                                    href="javascript:;">
                                    <div class="flex py-1">
                                        <div class="my-auto">
                                            <img src="./assets/img/team-2.jpg"
                                                class="inline-flex items-center justify-center mr-4 text-white text-sm h-9 w-9 max-w-none rounded-xl" />
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-1 font-normal leading-normal text-sm"><span
                                                    class="font-semibold">New message</span> from Laur</h6>
                                            <p class="mb-0 leading-tight text-xs text-slate-400">
                                                <i class="mr-1 fa fa-clock"></i>
                                                13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="relative mb-2">
                                <a class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg px-4 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700"
                                    href="javascript:;">
                                    <div class="flex py-1">
                                        <div class="my-auto">
                                            <img src="./assets/img/small-logos/logo-spotify.svg"
                                                class="inline-flex items-center justify-center mr-4 text-white text-sm bg-gradient-to-tl from-gray-900 to-slate-800 h-9 w-9 max-w-none rounded-xl" />
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-1 font-normal leading-normal text-sm"><span
                                                    class="font-semibold">Newaaaaa album</span> by Travis Scott</h6>
                                            <p class="mb-0 leading-tight text-xs text-slate-400">
                                                <i class="mr-1 fa fa-clock"></i>
                                                1 day
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="relative">
                                <a class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg px-4 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700"
                                    href="javascript:;">
                                    <div class="flex py-1">
                                        <div
                                            class="inline-flex items-center justify-center my-auto mr-4 text-white transition-all duration-200 ease-nav-brand text-sm bg-gradient-to-tl from-slate-600 to-slate-300 h-9 w-9 rounded-xl">
                                            <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <title>credit-card</title>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                        fill-rule="nonzero">
                                                        <g transform="translate(1716.000000, 291.000000)">
                                                            <g transform="translate(453.000000, 454.000000)">
                                                                <path class="color-background"
                                                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                    opacity="0.593633743"></path>
                                                                <path class="color-background"
                                                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-1 font-normal leading-normal text-sm">Payment
                                                successfully completed</h6>
                                            <p class="mb-0 leading-tight text-xs text-slate-400">
                                                <i class="mr-1 fa fa-clock"></i>
                                                2 days
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            </div>
        </nav>

        {{-- perfil jcst --}}
        @php
            use App\Http\Controllers\Auth\AuthenticatedSessionController;
            $authController = new AuthenticatedSessionController();
            $usuario = $authController->dashboard();
        @endphp
        <div class="w-full px-6 mx-auto">
            <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover h-6 rounded-2xl">
                {{--
                    <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover min-h-75 rounded-2xl">
            <img src="{{ $usuario->portada_photo_path }}" alt="foto de portada"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; object-position: top;">
                    --}}
            </div>


            <div
                class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-auto max-w-full px-3">
                        <div
                            class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">
                            <img src="{{ $usuario->profile_photo_path }}" alt="profile_image"
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
                    <div
                        class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                        <div class="relative right-0">
                            <ul class="relative flex flex-wrap p-1 list-none bg-transparent rounded-xl" nav-pills
                                role="tablist">

                                <li class="z-30 flex-auto text-center">
                                    <a class="block w-full px-0 py-1 mb-0 transition-all border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700 {{ request()->routeIs('novedades') ? 'text-black font-bold' : '' }}"
                                        href="{{ route('novedades') }}" role="tab"
                                        aria-selected="{{ request()->routeIs('novedades') ? 'true' : 'false' }}">
                                        <span class="ml-1">News</span>
                                    </a>
                                </li>
                                <li class="z-30 flex-auto text-center">
                                    <a class="z-30 block w-full px-0 py-1 mb-0 transition-all border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700 {{ request()->routeIs('#') ? 'bg-gray-400 text-slate-700' : '' }}"
                                        href="#" role="tab"
                                        aria-selected="{{ request()->routeIs('#') ? 'true' : 'false' }}">
                                        <span class="ml-1">Album</span>
                                    </a>
                                </li>
                                <li class="z-30 flex-auto text-center">
                                    <a class="z-30 block w-full px-0 py-1 mb-0 transition-colors border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700 {{ request()->routeIs('#') ? 'bg-gray-400 text-slate-700' : '' }}"
                                        href="#" role="tab"
                                        aria-selected="{{ request()->routeIs('#') ? 'true' : 'false' }}">
                                        <span class="ml-1">Invitaciones</span>
                                    </a>
                                </li>
                                <li class="z-30 flex-auto text-center">
                                    <a class="z-30 block w-full px-0 py-1 mb-0 transition-colors border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700 {{ request()->routeIs('cart.show') ? 'text-black font-bold' : '' }}"
                                        href="{{ route('cart.show') }}" role="tab"
                                        aria-selected="{{ request()->routeIs('cart.show') ? 'true' : 'false' }}">
                                        <span class="ml-1">Carrito</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- cards -->
        <div class="w-full px-6 py-6 mx-auto">
            <!-- row 1 -->





            @yield('jcst')











            {{-- <footer class="pt-4">
                <div class="w-full px-6 mx-auto">
                    <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                        <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                            <div class="leading-normal text-center text-sm text-slate-500 lg:text-left">
                                Julio Company
                            </div>
                        </div>
                    </div>
                </div>
            </footer> --}}
        </div>
        <!-- end cards -->
    </main>

    <!-- plugin for charts  -->
    <script src="./assets/js/plugins/chartjs.min.js" async></script>
    <!-- plugin for scrollbar  -->
    <script src="./assets/js/plugins/perfect-scrollbar.min.js" async></script>
    {{-- Scripts by julico xD --}}
    @yield('scripts')
    <!-- github button -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- main script file  -->
    <script src="./assets/js/soft-ui-dashboard-tailwind.js?v=1.0.4" async></script>
    @stack('modals')
    @livewireScripts
    @stack('js')
</body>

</html>
