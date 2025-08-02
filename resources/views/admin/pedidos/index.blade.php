@extends('layouts.admin')

@section('contenido')
<h2>Pedidos</h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $pedido)
            <tr>
                <td>#{{ $pedido->id }}</td>
                <td>
                    <strong>{{ $pedido->cliente ?? 'Sin nombre' }}</strong><br>
                    <small>{{ $pedido->telefono ?? 'Sin número' }}</small>
                </td>
                <td><span class="badge bg-secondary">{{ ucfirst($pedido->estado) }}</span></td>
                <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                <td><a href="{{ route('admin.pedidos.show', $pedido) }}" class="btn btn-sm btn-primary">Ver</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
