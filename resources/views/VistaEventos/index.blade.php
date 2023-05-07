@extends('index')

@section('jcst')
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        <a href="{{ route('evento.create') }}">Crear Eventos</a>
    </button>
@endsection
