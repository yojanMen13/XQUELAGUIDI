@extends('layouts.admin')
@section('titulo', 'Tallas')
@section('contenido')
<h2>Tallas</h2>
<a href="{{ route('admin.tallas.create') }}" class="btn btn-success mb-3">+ Nueva talla</a>
<table class="table">
    <thead>
        <tr>
            <th>Etiqueta</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tallas as $talla)
            <tr>
                <td>{{ $talla->etiqueta }}</td>
                <td>
                    <a href="{{ route('admin.tallas.edit', $talla) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('admin.tallas.destroy', $talla) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
