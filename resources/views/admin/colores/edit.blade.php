@extends('layouts.admin')
@section('titulo', 'Editar color')
@section('contenido')
<h2>Editar color</h2>
<form method="POST" action="{{ route('admin.colores.update', $color) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ $color->nombre }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Código HEX</label>
        <input type="text" name="codigo_hex" value="{{ $color->codigo_hex }}" class="form-control">
    </div>
    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('admin.colores.index') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection
