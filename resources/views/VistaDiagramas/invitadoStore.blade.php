@extends('index');

@section('encabezado')
@endsection

@section('jcst')
    <form action="{{ route('invitados.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="flex justify-center mb-8">
            <input type="text" name="id_diagrama" value="{{ $diagrama->id }}" hidden>
            <textarea name="invitados" placeholder="Correos de los invitados separados por comas" required
                class="border border-gray-300 px-4 py-2 rounded-l-md w-64"></textarea>
            <button class="bg-green-500 text-white px-4 py-2 rounded-r-md">Invitar</button>
        </div>
    </form>
@endsection


@section('scripts')
@endsection
