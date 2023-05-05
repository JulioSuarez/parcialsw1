@extends('template.profile')

@section('jcst')
    {{-- titulo centrado --}}
    <div class="my-6 flex justify-center">
        <h1 class="text-3xl text-gray-900 dark:text-gray-100">Lista de Clientes</h1>
    </div>


    {{-- tabla de planes --}}

    <div class="flex justify-center">
        <div class="w-fit">
            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                    <thead class="bg-blue-500 text-white">
                        <tr
                        class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700 text-gray-300 h-12 bg-gray-800">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Correo</th>
                        <th class="px-4 py-3">Fecha Nacimiento</th>
                        <th class="px-4 py-3">Genero</th>
                        <th class="px-4 py-3">Telefono</th>
                        <th class="px-4 py-3">Foto Perfil</th>
                        <th class="px-4 py-3">Foto Portada</th>
                        <th class="px-4 py-3">Plan</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($clientes) --}}
                        @forelse ($clientes as $c)
                            <tr class="text-center bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                <td class="py-4 px-6 text-sm border-b border-grey-light">{{ $c->id }}</td>
                                <td class="py-4 px-6 text-sm border-b border-grey-light">{{ $c->name }}</td>
                                <td class="py-4 px-6 text-sm border-b border-grey-light">{{ $c->email }}</td>
                                <td class="py-4 px-6 text-sm border-b border-grey-light">{{ $c->fecha_nacimiento }}</td>
                                <td class="py-4 px-6 text-sm border-b border-grey-light uppercase">{{ $c->genero }}</td>
                                <td class="py-4 px-6 text-sm border-b border-grey-light">{{ $c->telefono }}</td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <div class="flex px-2 py-1">
                                        <img src="{{ asset('img/fotosClientes/'.$c->foto_perfil) }}"
                                            class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                            alt="xd" />
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <div class="flex px-2 py-1">
                                        <img src="{{ asset('img/fotosClientes/'.$c->foto_portada) }}"
                                            class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                            alt="xd" />
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm border-b border-grey-light">{{ $c->id_plan }}</td>
                                {{-- Acciones --}}
                                <td class="py-4 px-6 border-b border-grey-light">
                                    <div class="flex justify-center">
                                        <a href="{{ route('Cliente.edit', $c->id) }}"
                                            class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline inline-block">
                                            Editar
                                        </a>
                                        <form action="{{ route('Cliente.destroy', $c->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline inline-block"
                                                type="submit">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Tipo de plan</td>
                                <td class="py-4 px-6 border-b border-grey-light">precio</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    acciones
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- titulo centrado --}}
    <div class="my-6 flex justify-center">
        <h1 class="text-3xl text-gray-900 dark:text-gray-100">Crear Cliente</h1>
    </div>

    <div class="flex justify-center">
        <div class="w-full md:w-2/3 lg:w-1/2">
            <div class="bg-white rounded-lg shadow-lg px-8 pt-6 pb-8 mb-4">
                <form method="POST" action="{{ route('Cliente.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="name">
                            Nombre
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="name" type="text" name="name" value="{{ old('name') }}"
                            placeholder="Nombre completo" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="email">
                            Correo electrónico
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="email" type="email" name="email" value="{{ old('email') }}"
                            placeholder="example@mail.com" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="fecha_nacimiento">
                            Fecha de nacimiento
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="fecha_nacimiento" type="date" name="fecha_nacimiento"
                            value="{{ old('fecha_nacimiento') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="genero">
                            Género
                        </label>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="genero" name="genero" required>
                            <option value="" disabled selected>Seleccione su género</option>
                            <option value="m">Masculino</option>
                            <option value="f">Femenino</option>
                            {{-- <option value="o">Otro</option> --}}
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="password">
                            Contraseña
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="password" type="password" name="password" placeholder="********" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="foto_perfil">
                            Foto de perfil
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="foto_perfil" type="file" name="foto_perfil" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="foto_portada">
                            Foto de portada
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="foto_portada" type="file" name="foto_portada" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="telefono">
                            Teléfono
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="telefono" type="tel" name="telefono" value="{{ old('telefono') }}"
                            placeholder="0000-0000" required>

                        @error('telefono')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    {{--
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="direccion">
                            Dirección
                        </label>
                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline resize-none"
                            id="direccion" name="direccion" placeholder="Dirección" required>{{ old('direccion') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="descripcion">
                            Descripción
                        </label>
                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline resize-none"
                            id="descripcion" name="descripcion" placeholder="Descripción" required>{{ old('descripcion') }}</textarea>
                    </div> --}}

                    <div class="mb-4">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mr-2 focus:outline-none focus:shadow-outline inline-block"
                            type="submit">
                            Crear
                        </button>
                        <a href="{{ route('Cliente.index') }}"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline inline-block">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
