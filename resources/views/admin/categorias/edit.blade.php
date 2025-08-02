@extends('layouts.admin')

@section('titulo', 'Editar Categoría')

@section('contenido')
    <h1>Editar Categoría</h1>

    <form action="{{ route('admin.categorias.update', $categoria) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $categoria->nombre) }}" required>
        </div>
        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
