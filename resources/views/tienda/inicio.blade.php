@extends('layouts.tienda')

@section('titulo', 'Inicio')

@section('contenido')

    {{-- Botón flotante de Ver Carrito (lado derecho) --}}
<a href="{{ route('carrito.index') }}"
   class="fixed bottom-4 left-4 z-50 bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-full shadow-lg text-sm sm:hidden"
   title="Ver carrito">
   <i class="fas fa-shopping-cart me-1"></i> Ver carrito
</a>


    {{-- HERO / PORTADA --}}
    <section class="bg-beige-50 py-10">
        <div class="max-w-screen-xl mx-auto px-4 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 text-center lg:text-left mb-8 lg:mb-0">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">
                    Huaraches<br> auténticos de alta calidad
                </h1>
                <p class="text-lg text-gray-600 mb-6">Diseño artesanal mexicano. Cómodos, resistentes y con estilo.</p>
                <a href="{{ route('tienda.categoria', 'damas') }}"
                    class="inline-block bg-orange-600 text-white px-6 py-3 rounded-lg text-sm hover:bg-orange-700 transition">
                    Comprar ahora
                </a>
            </div>
            <div class="lg:w-1/2">
                <img src="{{ asset('img/hero-huarache.png') }}" alt="Huarache hero" class="w-full max-w-md mx-auto lg:mx-0">
            </div>
        </div>
    </section>

    {{-- PRODUCTOS DESTACADOS --}}
    <section class="py-14 bg-white">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Productos Destacados</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach ($destacados as $producto)
                    <div class="bg-white border rounded-lg overflow-hidden shadow hover:shadow-md transition">
                        <a href="{{ route('tienda.producto', $producto->slug) }}">
                            <img src="{{ asset('storage/' . ($producto->imagenes->where('principal', true)->first()?->url ?? 'img/default.jpg')) }}"
                                class="w-full h-48 object-cover" alt="{{ $producto->nombre }}">
                        </a>
                        <div class="p-4 text-center">
                            <h3 class="font-semibold text-sm truncate mb-1">{{ $producto->nombre }}</h3>
                            <p class="text-gray-600 text-sm mb-2">${{ number_format($producto->precio, 2) }}</p>
                            <a href="{{ route('carrito.agregar', $producto->id) }}"
                                class="bg-orange-600 hover:bg-orange-700 text-white px-3 py-1 rounded text-xs">
                                Agregar al carrito
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- MÁS VENDIDOS --}}
    <section class="py-14 bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Lo más vendido</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach ($mas_vendidos as $producto)
                    <div class="bg-white border rounded-lg overflow-hidden shadow hover:shadow-md transition">
                        <a href="{{ route('tienda.producto', $producto->slug) }}">
                            <img src="{{ asset('storage/' . ($producto->imagenes->where('principal', true)->first()?->url ?? 'img/default.jpg')) }}"
                                class="w-full h-48 object-cover" alt="{{ $producto->nombre }}">
                        </a>
                        <div class="p-4 text-center">
                            <h3 class="text-sm font-semibold text-gray-800 truncate mb-1">{{ $producto->nombre }}</h3>
                            <p class="text-gray-600 text-sm mb-2">${{ number_format($producto->precio, 2) }}</p>
                            <a href="{{ route('carrito.agregar', $producto->id) }}"
                                class="bg-orange-600 hover:bg-orange-700 text-white px-3 py-1 rounded text-xs">
                                Agregar al carrito
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- CATEGORÍAS --}}
    <section class="py-14 bg-beige-50">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Categorías</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('tienda.categoria', 'damas') }}"
                    class="relative group rounded-lg overflow-hidden shadow">
                    <img src="{{ asset('img/categoria-damas.jpg') }}"
                        class="w-full h-56 object-cover group-hover:scale-105 transition duration-300">
                    <div class="absolute bottom-0 bg-black bg-opacity-40 text-white p-4 w-full text-xl font-semibold">Damas
                    </div>
                </a>
                <a href="{{ route('tienda.categoria', 'caballeros') }}"
                    class="relative group rounded-lg overflow-hidden shadow">
                    <img src="{{ asset('img/categoria-caballeros.jpg') }}"
                        class="w-full h-56 object-cover group-hover:scale-105 transition duration-300">
                    <div class="absolute bottom-0 bg-black bg-opacity-40 text-white p-4 w-full text-xl font-semibold">
                        Caballeros</div>
                </a>
            </div>
        </div>
    </section>

    {{-- ACERCA DE NOSOTROS --}}
    <section class="py-14 bg-white">
        <div class="max-w-screen-lg mx-auto px-4 flex flex-col md:flex-row items-center gap-8">
            <img src="{{ asset('img/about.jpg') }}" class="w-full md:w-1/2 rounded-lg shadow">
            <div class="md:w-1/2">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Acerca de Nosotros</h2>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Hechos a mano por artesanos mexicanos, nuestros huaraches combinan comodidad y durabilidad,
                    preservando la tradición y el diseño auténtico. XQUELAGUIDI es más que calzado: es identidad.
                </p>
            </div>
        </div>
    </section>

@endsection
