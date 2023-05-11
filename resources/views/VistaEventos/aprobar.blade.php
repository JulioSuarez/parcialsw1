@extends('index')

@section('jcst')
    <div class="max-w-screen-md mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-4">aprobar fotos</h1>
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Foto</th>
                        <th class="px-4 py-2">Aprobar</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($fotos as $f)
                    {{-- @dd($f) --}}
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex justify-center px-2 py-1">
                                    <div>
                                        <img src="{{ asset('img/fotoClientes/' . $f->foto_original) }}"
                                            class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                            alt="foto" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    {{-- <tr>
                        <td class="border px-4 py-2">1</td>
                        <td class="border px-4 py-2">Producto 1</td>
                        <td class="border px-4 py-2">50</td>
                        <td class="border px-4 py-2">$10.00</td>
                        <td class="border px-4 py-2">$500.00</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2</td>
                        <td class="border px-4 py-2">Producto 2</td>
                        <td class="border px-4 py-2">20</td>
                        <td class="border px-4 py-2">$15.00</td>
                        <td class="border px-4 py-2">$300.00</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">3</td>
                        <td class="border px-4 py-2">Producto 3</td>
                        <td class="border px-4 py-2">30</td>
                        <td class="border px-4 py-2">$20.00</td>
                        <td class="border px-4 py-2">$600.00</td>
                    </tr> --}}
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <td class="border px-4 py-2" colspan="4">Total de ventas:</td>
                        <td class="border px-4 py-2">$1400.00</td>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
    </div>
@endsection
