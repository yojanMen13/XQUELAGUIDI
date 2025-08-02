@extends('layouts.admin')

@section('titulo', 'Editar Producto')

@section('contenido')
    <h1 class="mb-4 fw-bold text-dark">Editar producto</h1>

    {{-- FORMULARIO BASE DEL PRODUCTO --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-dark text-white">
            <i class="fas fa-box"></i> Información básica
        </div>
        <div class="card-body">
            <form action="{{ route('admin.productos.update', $producto) }}" method="POST">
                @csrf @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Categoría</label>
                        <select name="categoria_id" class="form-select" required>
                            @foreach ($categorias as $cat)
                                <option value="{{ $cat->id }}" {{ $producto->categoria_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Precio</label>
                        <input type="number" name="precio" value="{{ $producto->precio }}" step="0.01" class="form-control" required>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" rows="3" class="form-control">{{ $producto->descripcion }}</textarea>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button class="btn btn-success px-4"><i class="fas fa-save me-1"></i> Guardar cambios</button>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    {{-- VARIANTES DEL PRODUCTO --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-info text-white">
            <i class="fas fa-layer-group"></i> Variantes (color, talla, stock)
        </div>
        <div class="card-body">

            {{-- Formulario de nueva variante --}}
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('admin.variantes.store', $producto) }}" method="POST" class="row g-3 mb-4">
                @csrf
                <div class="col-md-4">
                    <label class="form-label">Color</label>
                    <select name="color_id" class="form-select" required>
                        @foreach (\App\Models\Color::all() as $color)
                            <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Talla</label>
                    <select name="talla_id" class="form-select" required>
                        @foreach (\App\Models\Talla::all() as $talla)
                            <option value="{{ $talla->id }}">{{ $talla->etiqueta }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" min="0" required>
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button class="btn btn-success w-100"><i class="fas fa-plus"></i></button>
                </div>
            </form>

            {{-- Tabla de variantes --}}
            @if ($producto->variantes->count())
                <table class="table table-sm table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Color</th>
                            <th>Talla</th>
                            <th>Stock</th>
                            <th style="width: 100px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($producto->variantes as $variante)
                            <tr>
                                <td>{{ $variante->color->nombre }}</td>
                                <td>{{ $variante->talla->etiqueta }}</td>
                                <td><span class="badge bg-secondary">{{ $variante->stock }}</span></td>
                                <td>
                                    <form action="{{ route('admin.variantes.destroy', $variante) }}" method="POST" onsubmit="return confirm('¿Eliminar esta variante?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger w-100">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No hay variantes registradas para este producto.</p>
            @endif
        </div>
    </div>

    {{-- GALERÍA DE IMÁGENES --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-secondary text-white">
            <i class="fas fa-images"></i> Galería de imágenes
        </div>
        <div class="card-body">

            {{-- Subida de nueva imagen --}}
            <form action="{{ route('admin.imagenes.store', $producto) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <input type="file" name="imagen" class="form-control" accept="image/*" required>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary w-100">Subir imagen</button>
                    </div>
                </div>
            </form>

            {{-- Miniaturas existentes --}}
            @if ($producto->imagenes->count())
                <div class="row g-3">
                    @foreach ($producto->imagenes as $img)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('storage/' . $img->url) }}" class="card-img-top" alt="Imagen producto">
                                <div class="card-body p-2 text-center">
                                    @if ($img->principal)
                                        <span class="badge bg-success mb-2 d-block">Principal</span>
                                    @else
                                        <form action="{{ route('admin.imagenes.principal', $img) }}" method="POST" class="mb-2">
                                            @csrf @method('PUT')
                                            <button class="btn btn-sm btn-outline-primary w-100">Marcar principal</button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.imagenes.destroy', $img) }}" method="POST" onsubmit="return confirm('¿Eliminar esta imagen?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger w-100">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No hay imágenes subidas para este producto.</p>
            @endif
        </div>
    </div>
@endsection
