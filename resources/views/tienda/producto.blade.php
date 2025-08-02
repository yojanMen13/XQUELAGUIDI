@extends('layouts.tienda')

@section('titulo', $producto->nombre)

@section('contenido')
<div class="max-w-screen-xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

    {{-- Galería principal --}}
    <div>
        @if($producto->imagenes->count())
            <div x-data="{ img: '{{ asset('storage/' . $producto->imagenes->first()->url) }}' }" class="space-y-4">
                {{-- Imagen principal --}}
                <div class="aspect-square bg-white rounded shadow overflow-hidden">
                    <img :src="img" alt="Imagen principal"
                         class="w-full h-full object-cover transition duration-300 ease-in-out">
                </div>

                {{-- Miniaturas --}}
                @if($producto->imagenes->count() > 1)
                    <div class="flex gap-2 overflow-x-auto">
                        @foreach($producto->imagenes as $img)
                            <img src="{{ asset('storage/' . $img->url) }}"
                                 @click="img = '{{ asset('storage/' . $img->url) }}'"
                                 class="w-20 h-20 object-cover rounded cursor-pointer border-2 hover:border-orange-500 transition duration-300"
                                 alt="Miniatura">
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="text-gray-500 italic">No hay imágenes disponibles.</div>
        @endif
    </div>

    {{-- Información y variaciones --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $producto->nombre }}</h1>
        <p class="text-xl text-orange-600 font-semibold mb-4">${{ number_format($producto->precio, 2) }}</p>
        <p class="text-gray-600 leading-relaxed mb-6">{{ $producto->descripcion }}</p>

        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST" class="space-y-5">
            @csrf

            {{-- Selector de Color --}}
            <div>
                <label for="color_id" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                <select id="color_id" name="color_id"
                        class="w-full border border-gray-300 rounded px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                        required>
                    @foreach ($producto->variantes->pluck('color')->unique('id') as $color)
                        <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Selector de Talla --}}
            <div>
                <label for="talla_id" class="block text-sm font-medium text-gray-700 mb-1">Talla</label>
                <select id="talla_id" name="talla_id"
                        class="w-full border border-gray-300 rounded px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                        required>
                    @foreach ($producto->variantes->pluck('talla')->unique('id') as $talla)
                        <option value="{{ $talla->id }}">{{ $talla->etiqueta }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                    class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-3 rounded transition">
                Agregar al carrito
            </button>
        </form>
    </div>
</div>
@endsection
