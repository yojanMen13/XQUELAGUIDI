@props(['producto'])

<a href="{{ route('tienda.producto', $producto->slug) }}"
    class="block bg-white rounded-xl shadow hover:shadow-lg overflow-hidden transition-all duration-300 group cursor-pointer focus:outline-none focus:ring">

    <div class="aspect-[4/5]">
        <img src="{{ asset('storage/' . ($producto->imagenes->where('principal', true)->first()?->url ?? 'img/default.jpg')) }}"
             alt="{{ $producto->nombre }}"
             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
    </div>

    <div class="p-3">
        <h5 class="font-semibold text-base truncate">{{ $producto->nombre }}</h5>
        <p class="text-gray-700 text-sm">${{ number_format($producto->precio, 2) }}</p>
        <span class="inline-block mt-2 px-2 py-1 bg-indigo-100 text-indigo-700 text-xs rounded-full">
            Ver detalles
        </span>
    </div>
</a>
