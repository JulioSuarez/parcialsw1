@extends('index')

@section('jcst')
    <div class="max-w-screen-md mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Reporte de Ventas</h1>
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Producto</th>
                        <th class="px-4 py-2">Cantidad Vendida</th>
                        <th class="px-4 py-2">Precio Unitario</th>
                        <th class="px-4 py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
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
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="border px-4 py-2" colspan="4">Total de ventas:</td>
                        <td class="border px-4 py-2">$1400.00</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
