@extends('index');

@section('encabezado')
@endsection

@section('jcst')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Agregar Atributo</h2>
        <form action="{{ route('atributoStore') }}" method="POST" class="w-full max-w-sm">
            @csrf
            <div class="mb-4">
                <label for="sintaxis" class="block text-gray-700">Tipo de Sintaxis</label>
                <select name="sintaxis" id="sintaxis" class="w-full border border-gray-300 px-4 py-2 rounded-md">
                    <option value="mysql" selected disabled>Elija una opcion</option>
                    <option value="postgresql">PostgreSQL</option>
                    <option value="sqlserver">SQL Server</option>
                </select>
            </div>

            <div id="postgreSQLFields" class="hidden">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nombre del Atributo</label>
                    <input type="text" name="name" id="name"
                        class="w-full border border-gray-300 px-4 py-2 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="data_type_postgresql" class="block text-gray-700">Tipo de Datos</label>
                    <select name="data_type_postgresql" id="data_type_postgresql"
                        class="w-full border border-gray-300 px-4 py-2 rounded-md">
                        <option value="int">INT</option>
                        <option value="varchar">VARCHAR</option>
                        <option value="date">DATE</option>
                        <option value="float">FLOAT</option>
                        <option value="bigint">BIGINT</option>
                    </select>
                </div>
                <div class="mb-4">
                    <input type="radio" name="primary_key" value="true" id="primary_key_postgresql" class="mr-2">
                    <label for="primary_key_postgresql" class="text-gray-700">Llave Primaria</label>
                </div>
                <div class="mb-4">
                    <input type="radio" name="foreign_key" value="true" id="foreign_key_postgresql" class="mr-2">
                    <label for="foreign_key_postgresql" class="text-gray-700">Llave Foránea</label>
                    <select name="foreign_key_reference_postgresql" id="foreign_key_reference_postgresql"
                        class="w-full border border-gray-300 px-4 py-2 rounded-md mt-2">
                        <option value="referencia1">Referencia 1</option>
                        <option value="referencia2">Referencia 2</option>
                        <option value="referencia3">Referencia 3</option>
                    </select>
                </div>
            </div>

            <div id="sqlServerFields" class="hidden">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nombre del Atributo</label>
                    <input type="text" name="name" id="name"
                        class="w-full border border-gray-300 px-4 py-2 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="data_type_sqlserver" class="block text-gray-700">Tipo de Datos</label>
                    <select name="data_type_sqlserver" id="data_type_sqlserver"
                        class="w-full border border-gray-300 px-4 py-2 rounded-md">
                        <option value="integer">INTEGER</option>
                        <option value="varchar">VARCHAR</option>
                        <option value="date">DATE</option>
                        <option value="real">REAL</option>
                        <option value="serial">SERIAL</option>
                    </select>
                </div>
                <div class="mb-4">
                    <input type="radio" name="primary_key" id="primary_key_sqlserver" class="mr-2">
                    <label for="primary_key_sqlserver" class="text-gray-700">Llave Primaria</label>
                </div>
                <div class="mb-4">
                    <input type="radio" name="foreign_key" id="foreign_key_sqlserver" class="mr-2">
                    <label for="foreign_key_sqlserver" class="text-gray-700">Llave Foránea</label>
                    <select name="foreign_key_reference_sqlserver" id="foreign_key_reference_sqlserver"
                        class="w-full border border-gray-300 px-4 py-2 rounded-md mt-2">
                        <option value="referencia1">Referencia 1</option>
                        <option value="referencia2">Referencia 2</option>
                        <option value="referencia3">Referencia 3</option>
                    </select>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Guardar</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const sintaxisSelect = document.getElementById('sintaxis');
        const postgreSQLFields = document.getElementById('postgreSQLFields');
        const sqlServerFields = document.getElementById('sqlServerFields');

        sintaxisSelect.addEventListener('change', function() {
            if (sintaxisSelect.value === 'postgresql') {
                postgreSQLFields.classList.remove('hidden');
                sqlServerFields.classList.add('hidden');
            } else if (sintaxisSelect.value === 'sqlserver') {
                postgreSQLFields.classList.add('hidden');
                sqlServerFields.classList.remove('hidden');
            }
        });
    </script>
@endsection
