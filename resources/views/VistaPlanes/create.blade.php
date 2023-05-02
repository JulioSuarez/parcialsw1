@extends('template.profile')

@section('jcst')
    {{-- formulario para crear cliente --}}

    {{-- titulo centrado --}}
    <div class="flex justify-center">
        <h1 class="text-3xl text-gray-900 dark:text-gray-100">Crear plan</h1>
    </div>

    <div class="flex justify-center">
        <div class="w-full md:w-2/3 lg:w-1/2">
            <div class="bg-white rounded-lg shadow-lg px-8 pt-6 pb-8 mb-4">
                <form method="POST" action="{{ route('planes.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="tipo_plan">
                            Nombre del plan
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="tipo_plan" type="text" name="tipo_plan" value="{{ old('tipo_plan') }}"
                            placeholder="Nombre del plan" required>
                    </div>


                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="precio">
                            Precio
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5">
                                    Bs.
                                </span>
                            </div>
                            <input class="form-input rounded-md shadow-sm block w-full pl-7 pr-12 sm:text-sm sm:leading-5"
                                id="precio" type="text" name="precio" placeholder="0.00"
                                aria-describedby="precio-currency" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5" id="precio-currency">
                                    BOB
                                </span>
                            </div>
                        </div>
                        @error('precio')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mr-2 focus:outline-none focus:shadow-outline inline-block"
                            type="submit">
                            Crear
                        </button>
                        <a href="{{ route('planes.index') }}"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline inline-block">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
