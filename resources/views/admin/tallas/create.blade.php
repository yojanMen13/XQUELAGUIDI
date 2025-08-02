@extends('layouts.admin')
@section('titulo', 'Nueva talla')

@section('contenido')
<h2>Nueva talla</h2>

@if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('admin.tallas.store') }}">
    @csrf
    <div class="mb-3">
        <label>Etiqueta</label>
        <input type="text" name="etiqueta" class="form-control" value="{{ old('etiqueta') }}" required>
    </div>
    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('admin.tallas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
