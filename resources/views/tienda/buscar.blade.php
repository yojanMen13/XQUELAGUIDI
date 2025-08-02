@extends('layouts.tienda')

@section('titulo', 'Resultados de búsqueda')

@section('contenido')
<div class="max-w-screen-xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        Resultados para: "{{ $query }}"
    </h1>

    @if($resultados->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($resultados as $producto)
                <div class="bg-white border rounded-lg overflow-hidden shadow hover:shadow-md transition">
                    <a href="{{ route('tienda.producto', $producto->slug) }}">
                        <img src="{{ asset('storage/' . ($producto->imagenes->where('principal', true)->first()?->url ?? 'img/default.jpg')) }}"
                             alt="{{ $producto->nombre }}"
                             class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                    </a>
                    <div class="p-4 text-center">
                        <h3 class="text-sm font-semibold text-gray-800 truncate mb-1">{{ $producto->nombre }}</h3>
                        <p class="text-gray-600 text-sm mb-2">${{ number_format($producto->precio, 2) }}</p>
                        <a href="{{ route('tienda.producto', $producto->slug) }}"
                           class="inline-block bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 text-xs rounded">
                            Ver producto
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 italic">No se encontraron productos.</p>
    @endif
</div>
@endsection
