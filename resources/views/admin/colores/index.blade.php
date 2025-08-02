@extends('layouts.admin')

@section('titulo', 'Colores')

@section('contenido')
<h2>Colores</h2>
<a href="{{ route('admin.colores.create') }}" class="btn btn-success mb-3">+ Nuevo color</a>

<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Código HEX</th>
            <th>Vista</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($colores as $color)
            <tr>
                <td>{{ $color->nombre }}</td>
                <td>{{ $color->codigo_hex }}</td>
                <td><span style="display:inline-block;width:25px;height:25px;background:{{ $color->codigo_hex }};border:1px solid #ccc;"></span></td>
                <td>
                    <a href="{{ route('admin.colores.edit', $color) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('admin.colores.destroy', $color) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
