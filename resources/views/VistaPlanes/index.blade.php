@extends('template.profile')

@section('jcst')
    {{-- boton crear planes --}}
    <div class="flex justify-start my-5 mx-6">
        <a href="{{ route('planes.create') }}"
            class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out">
            Crear Plan
        </a>
    </div>

    {{-- tabla de planes --}}

    <div class="flex justify-center">
        <div class="w-fit">
            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th
                                class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                Nombre del plan
                            </th>
                            <th
                                class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                Precio
                            </th>
                            <th
                                class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($planes as $plan)
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $plan->tipo_plan }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $plan->precio }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    <div class="flex justify-center">
                                        <a href="{{ route('planes.edit', $plan->id) }}"
                                            class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline inline-block">
                                            Editar
                                        </a>
                                        <form action="{{ route('planes.destroy', $plan->id) }}" method="POST">
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
@endsection
