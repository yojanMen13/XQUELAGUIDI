@extends('layouts.admin')
@section('titulo', 'Nuevo color')
@section('contenido')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h2>Nuevo color</h2>
<form method="POST" action="{{ route('admin.colores.store') }}">
    @csrf
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Código HEX</label>
        <input type="text" name="codigo_hex" class="form-control" placeholder="#000000">
    </div>
    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('admin.colores.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
