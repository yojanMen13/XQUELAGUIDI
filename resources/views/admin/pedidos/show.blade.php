@extends('layouts.admin')

@section('contenido')
    <h2>Detalle del pedido #{{ $pedido->id }}</h2>

    <p><strong>Cliente:</strong> {{ $pedido->cliente }}</p>
    <p><strong>Teléfono:</strong>
        <a href="https://wa.me/52{{ $pedido->telefono }}" target="_blank">
            {{ $pedido->telefono }}
        </a>
    </p>

    <p><strong>Estado actual:</strong> {{ ucfirst($pedido->estado) }}</p>

    <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST" class="mb-3">
        @csrf @method('PUT')
        <label>Cambiar estado:</label>
        <select name="estado" class="form-select w-auto d-inline">
            @foreach (['pendiente', 'confirmado', 'entregado'] as $estado)
                <option value="{{ $estado }}" @selected($pedido->estado === $estado)>{{ ucfirst($estado) }}</option>
            @endforeach
        </select>
        <button class="btn btn-sm btn-success">Actualizar</button>
    </form>

    <h5>Productos en el pedido:</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Color</th>
                <th>Talla</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedido->items as $item)
                <tr>
                    <td>{{ $item->producto->nombre }}</td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->talla }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.pedidos.pdf', $pedido) }}" class="btn btn-outline-dark me-2">
        Descargar PDF
    </a>


    <a href="{{ route('admin.pedidos.index') }}" class="btn btn-secondary">← Volver</a>
@endsection
