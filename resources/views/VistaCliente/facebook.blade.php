@extends('index')

@section('jcst')
    @if ($errors->has('error'))
        <div class="error text-red-500 text-center animate-bounce" x-data="{ show: true }" x-show="show"
            x-init="setTimeout(() => show = false, 5000)">
            {{ $errors->first('error') }}
        </div>
    @endif


    @if (session('success'))
        <div class="bg-green-500 text-white text-center animate-bounce" x-data="{ show: true }" x-show="show"
            x-init="setTimeout(() => show = false, 5000)">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-row justify-center">
        {{-- tarjeta fotos --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
            @forelse ($fotos as $foto)
                {{-- @dd($foto) --}}
                <div class="mx-6">
                    <div class="flex justify-center">
                        <div class="max-w-sm rounded overflow-hidden shadow-lg">
                            <img class="w-full" src="{{ asset($foto->foto_renderizada) }}" alt="Imagen">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{ $foto->evento_name }}</div>
                                <p class="text-gray-700 text-base">
                                    Hola {{ auth()->user()->name }}, Nos parece que sales en esta foto
                                </p>
                            </div>
                            <div class="pt-4 pb-2 justify-center">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <div class="flex flex-row justify-center mb-2">
                                        <div class="mx-4">
                                            <input type="hidden" name="foto_id" value="{{ $foto->id }}">
                                            <input type="hidden" name="evento_name" value="{{ $foto->evento_name }}">
                                            <input class="rounded" type="number" name="quantity" value="1"
                                                min="1" style="width: 80px;">
                                        </div>
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty

                <div class="mx-12">
                    <div class="flex justify-center">

                        <div class="max-w-sm rounded overflow-hidden shadow-lg">
                            <img class="w-full"
                                src="https://kr4m.com/wp-content/uploads/2019/05/Webp.net-compress-image-3.jpg"
                                alt="Imagen">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">Evento Boda</div>
                                <p class="text-gray-700 text-base">
                                    Hola Julio, Apareces en esta foto
                                </p>
                            </div>
                            <div class="px-6 pt-4 pb-2">
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
