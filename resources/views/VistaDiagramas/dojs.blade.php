@extends('index')

@section('encabezado')
    <script src="https://gojs.net/latest/release/go.js"></script>

    <style>
        dialog[open] {
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
        }

        dialog::backdrop {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
            backdrop-filter: blur(3px);
        }


        @keyframes appear {
            from {
                opacity: 0;
                transform: translateX(-3rem);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
@endsection

@section('jcst')
    {{-- <button id="bt_abrir_modal" type="button"
        class=" text-xs font-medium rounded-lg px-1 py-1 border-2 border-black bg-white hover:bg-black hover:text-white  dark:bg-slate-800 text-black dark:border-white dark:hover:bg-white dark:hover:text-black">
        Ver Detalles
    </button> --}}

    <dialog id="myModal" class="h-1/1 w-80 lg:w-96  p-3 rounded-2xl ">

        <!--bt_cerrar_modal-->
        <button id="bt_cerrar_modal" type="button"
            class="cursor-pointer absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 6.707a1 1 0 011.414 0L10 8.586l3.293-3.293a1 1 0 111.414 1.414L11.414 10l3.293 3.293a1 1 0 01-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 10 5.293 6.707z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <div class=" flex items-center justify-center ">

            <div class="container mx-auto p-4">
                <h2 class="text-2xl font-bold mb-4 border-b-2">Agregar Atributo</h2>
                <div id="atributos" class="">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Nombre del Atributo</label>
                        <input type="text" name="name" id="name" required
                            class="w-full border border-gray-300 px-4 py-2 rounded-md">
                        <input type="text" name="id_diagrama" id="id_diagrama" value="{{ $d->id }}"
                            class="w-full border border-gray-300 px-4 py-2 rounded-md">

                        @forelse ($clases as $clase)
                            <input type="text" name="clase_id[]" id="clase[]" value="{{ $clase->id }}">
                            <input type="text" name="clase_name[]" id="clase[]" value="{{ $clase->name }}">
                            @foreach ($clase->atributos as $c)
                                <input type="text" name="atributo_id[]" id="atributo[]" value="{{ $c->id }}">
                                <input type="text" name="atributo_name[]" id="atributo[]" value="{{ $c->name }}">
                            @endforeach
                        @empty
                        @endforelse

                        {{--
                        @for ($i = 0; $i < count($clases); $i++)
                            <input type="text" name="clase[]" id="clase[]" value="{{ $clases[$i]->id }}"
                                class="w-full border border-gray-300 px-4 py-2 rounded-md">
                            @for ($j = 0; $j < count($clases[$i]->atributos); $j++)
                                <input type="text" name="atributo[]" id="atributo[]"
                                    value="{{ $clases[$i]->atributos[$j]->id }}"
                                    class="w-full border border-gray-300 px-4 py-2 rounded-md">
                            @endfor
                        @endfor --}}

                        {{-- <input type="text" name="id_diagrama" id="id_diagrama" value="{{ $clases }}"
                            class="w-full border border-gray-300 px-4 py-2 rounded-md"> --}}
                    </div>
                    <div class="mb-4">
                        <label for="data_type" class="block text-gray-700">Tipo de Datos</label>
                        <select name="data_type" id="data_type" class="w-full border border-gray-300 px-4 py-2 rounded-md">
                            <option disabled selected>Elija un tipo de dato</option>
                            @foreach ($tipod as $td)
                                <option value="{{ $td->name }}">{{ $td->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button id="saveButton" class="px-4 py-2 bg-blue-500 text-white rounded-md">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </dialog>

    <dialog id="relacion" class="h-1/1 w-80 lg:w-96  p-3 rounded-2xl ">

        <!--bt_cerrar_modal-->
        <button id="bt_cerrar_modal2" type="button"
            class="cursor-pointer absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 6.707a1 1 0 011.414 0L10 8.586l3.293-3.293a1 1 0 111.414 1.414L11.414 10l3.293 3.293a1 1 0 01-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 10 5.293 6.707z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <div class=" flex items-center justify-center ">

            <div class="container mx-auto p-4">
                <h2 class="text-2xl font-bold mb-4">Agregar Relación</h2>
                <form action="#" method="POST" class="w-full max-w-md">
                    @csrf

                    <div class="mb-4">
                        <label for="clase" class="block text-gray-700">Clase</label>
                        <select name="clase" id="clase" class="w-full border border-gray-300 px-4 py-2 rounded-md">
                            <option value="1">Clase 1 (id)</option>
                            <option value="11">Clase 11 (id)</option>
                            <option value="12">Clase 12 (id)</option>
                            <option value="13">Clase 13 (id)</option>
                            <option value="14">Clase 14 (id)</option>
                            <!-- Agrega las opciones restantes aquí -->
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="tipo_relacion" class="block text-gray-700">Tipo de Relación</label>
                        <select name="tipo_relacion" id="tipo_relacion"
                            class="w-full border border-gray-300 px-4 py-2 rounded-md">
                            <option value="agregacion">Agregación</option>
                            <option value="composicion">Composición</option>
                            <option value="herencia">Herencia</option>
                            <option value="asociacion">Asociación</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <button id="saveRelation" class="px-4 py-2 bg-blue-500 text-white rounded-md">Guardar</button>
                    </div>
                </form>
            </div>


        </div>
    </dialog>


    <div class="container mx-auto p-4">
        <div class="container mx-auto p-4 text-center">
            <button id="addButton" class="px-4 py-2 bg-blue-500 text-white rounded-md">Agregar nuevo diagrama de
                clase</button>
            <button id="exportar" class="px-4 py-2 bg-blue-500 text-white rounded-md">Exportar</button>
        </div>
        <div class="flex justify-center">
            {{-- <div class="w-1/5 bg-gray-200 p-4 rounded-md mr-2">
                <div class="border-b text-sm">
                </div>
            </div> --}}
            <div class="w-4/5 bg-white p-4 rounded-md border-black">
                <div id="myDiagramDiv" class="p-4 w-full h-screen"></div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @vite(['resources/js/modal.js'])
    {{-- NO funciono
        <script src="{{ resource_path('js/modal.js') }}" async></script> --}}
    <script src="./js/diagrama.js" async></script>

    {{-- <script>
        const sintaxisSelect = document.getElementById('sintaxis');
        const postgreSQLFields = document.getElementById('postgreSQLFields');
        const sqlServerFields = document.getElementById('sqlServerFields');


        const select_attribute_type_sql = document.getElementById('llave_sql');
        const SQLForanea = document.getElementById('SQLForanea');

        const select_attribute_type_pg = document.getElementById('select_attribute_type_pg');
        const PGForanea_pg = document.getElementById('PGForanea_pg');


        sintaxisSelect.addEventListener('change', function() {
            if (sintaxisSelect.value === 'postgresql') {
                postgreSQLFields.classList.remove('hidden');
                sqlServerFields.classList.add('hidden');
            } else if (sintaxisSelect.value === 'sqlserver') {
                postgreSQLFields.classList.add('hidden');
                sqlServerFields.classList.remove('hidden');
            }
        });
        select_attribute_type_sql.addEventListener('change', function() {
            if (select_attribute_type_sql.value === 'foreign_key_sql') {
                SQLForanea.classList.remove('hidden');
            } else if (select_attribute_type_sql.value === 'primary_key_sql') {
                SQLForanea.classList.add('hidden');
            } else if (select_attribute_type_sql.value === 'default') {
                SQLForanea.classList.add('hidden');
            }
        });

        select_attribute_type_pg.addEventListener('change', function() {
            if (select_attribute_type_pg.value === 'foreign_key_pg') {
                PGForanea_pg.classList.remove('hidden');
            } else if (select_attribute_type_pg.value === 'primary_key_pg') {
                PGForanea_pg.classList.add('hidden');
            } else if (select_attribute_type_pg.value === 'default_pg') {
                PGForanea_pg.classList.add('hidden');
            }
        });
    </script> --}}
@endsection
