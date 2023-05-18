@extends('index')

@section('jcst')
    <form id="form-aprobar" action="{{ route('organizadores.aprobado.store') }}" method="POST">
        @csrf
        <div class="max-w-screen-md mx-auto py-8 px-4">
            <h1 class="text-2xl font-bold mb-4">Aprobar fotos</h1>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b">Foto</th>
                            <th class="px-4 py-2 border-b">Aprobar/Rechazar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fotos as $f)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center px-2 py-1">
                                        <div>
                                            <img src="{{ asset('img/fotosClientes/' . $f->foto_original) }}"
                                                class="inline-flex items-center justify-center text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                alt="foto">
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex items-center justify-center px-2 py-1">
                                        <input type="radio" id="aprobar-{{ $f->id }}" name="fotos[{{ $f->id }}]" value="{{ $f->id }}_aprobada{{$f->id_album_evento}}" class="mr-4">
                                        <label for="aprobar-{{ $f->id }}" class="mr-4" onclick="toggleRadioButton(this)">Aprobar</label>
                                        <input type="radio" id="rechazar-{{ $f->id }}" name="fotos[{{ $f->id }}]" value="{{ $f->id }}_rechazada{{$f->id_album_evento}}" class="mr-4">
                                        <label for="rechazar-{{ $f->id }}">Rechazar</label>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">No hay fotos para mostrar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="flex items-center justify-center px-2 py-1">
                    <button id="btn-aprobar" class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600" disabled>
                        Aprobar
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        const btnAprobar = document.querySelector('#btn-aprobar');

        radioButtons.forEach((radioButton) => {
            radioButton.addEventListener('change', () => {
                btnAprobar.disabled = false;
            });
        });
    </script>
@endsection
