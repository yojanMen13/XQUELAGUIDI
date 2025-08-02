@extends('layouts.tienda')

@section('titulo', 'Carrito de compras')

@section('contenido')
<div class="max-w-screen-xl mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tu carrito</h1>

    {{-- Alertas --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    @if(count($carrito) > 0)

        {{-- Tabla de carrito --}}
        <div class="overflow-x-auto mb-8">
            <table class="w-full text-sm text-gray-700 border rounded-lg overflow-hidden shadow-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-3">Producto</th>
                        <th class="px-4 py-3">Color</th>
                        <th class="px-4 py-3">Talla</th>
                        <th class="px-4 py-3">Cantidad</th>
                        <th class="px-4 py-3">Precio</th>
                        <th class="px-4 py-3">Subtotal</th>
                        <th class="px-4 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @php $total = 0; @endphp
                    @foreach($carrito as $clave => $item)
                        @php
                            $subtotal = $item['precio'] * $item['cantidad'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $item['nombre'] }}</td>
                            <td class="px-4 py-3">{{ $item['color'] }}</td>
                            <td class="px-4 py-3">{{ $item['talla'] }}</td>
                            <td class="px-4 py-3">{{ $item['cantidad'] }}</td>
                            <td class="px-4 py-3">${{ number_format($item['precio'], 2) }}</td>
                            <td class="px-4 py-3">${{ number_format($subtotal, 2) }}</td>
                            <td class="px-4 py-3 text-center">
                                <form action="{{ route('carrito.eliminar', $clave) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 text-sm font-semibold transition">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <tr class="bg-gray-50 font-bold text-gray-800">
                        <td colspan="5" class="px-4 py-4 text-right">Total:</td>
                        <td class="px-4 py-4">${{ number_format($total, 2) }}</td>
                        <td class="px-4 py-4 text-center">
                            <form action="{{ route('carrito.vaciar') }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-gray-500 hover:text-gray-800 text-sm font-semibold">
                                    Vaciar
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Formulario de checkout --}}
        <div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-xl">
            <h2 class="text-lg font-semibold mb-4">Finalizar pedido por WhatsApp</h2>

            <form action="{{ route('checkout') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="cliente" class="block text-sm font-medium text-gray-700 mb-1">Tu nombre</label>
                    <input type="text" name="cliente" id="cliente" required
                        class="w-full border-gray-300 rounded px-4 py-2 text-sm focus:ring-orange-500 focus:border-orange-500">
                </div>

                <div>
                    <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Número de WhatsApp</label>
                    <input type="text" name="telefono" id="telefono" required
                        placeholder="Ej. 5551234567"
                        class="w-full border-gray-300 rounded px-4 py-2 text-sm focus:ring-orange-500 focus:border-orange-500">
                </div>

                <button type="submit"
                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-3 rounded transition">
                    Enviar pedido
                </button>
            </form>
        </div>

    @else
        <p class="text-gray-500 italic text-center">No tienes productos en tu carrito.</p>
    @endif
</div>
@endsection
