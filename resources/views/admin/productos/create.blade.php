@extends('layouts.admin')

@section('titulo', 'Nuevo Producto')

@section('contenido')
    <h1 class="mb-4 fw-bold text-dark">Crear nuevo producto</h1>

    <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- INFORMACIÓN GENERAL --}}
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-box"></i> Información general
            </div>
            <div class="card-body row g-4">
                <div class="col-md-6">
                    <label class="form-label">Nombre del producto</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Categoría</label>
                    <select name="categoria_id" class="form-select" required>
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" step="0.01" class="form-control" required>
                </div>

                <div class="col-md-8">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Detalles del producto..."></textarea>
                </div>
            </div>
        </div>

        {{-- IMAGEN PRINCIPAL --}}
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-secondary text-white">
                <i class="fas fa-image"></i> Imagen principal
            </div>
            <div class="card-body">
                <label class="form-label">Selecciona una imagen (JPG, PNG)</label>
                <input type="file" name="imagen" class="form-control" accept="image/*" onchange="vistaPrevia(event)" required>
                <div id="preview" class="mt-3"></div>
            </div>
        </div>

        {{-- VARIANTE INICIAL --}}
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-info text-white">
                <i class="fas fa-layer-group"></i> Primera variante (color, talla, stock)
            </div>
            <div class="card-body row g-4">
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

                <div class="col-md-4">
                    <label class="form-label">Stock inicial</label>
                    <input type="number" name="stock" class="form-control" min="0" required>
                </div>
            </div>
        </div>

        {{-- BOTONES --}}
        <div class="text-end">
            <button type="submit" class="btn btn-success px-4 me-2">
                <i class="fas fa-check"></i> Crear producto
            </button>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary px-4">
                Cancelar
            </a>
        </div>
    </form>

    {{-- SCRIPT para vista previa de imagen --}}
    <script>
        function vistaPrevia(event) {
            const archivo = event.target.files[0];
            const preview = document.getElementById('preview');
            preview.innerHTML = '';

            if (archivo) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(archivo);
                img.className = 'img-thumbnail shadow-sm mt-2';
                img.style.maxWidth = '250px';
                img.style.height = 'auto';
                preview.appendChild(img);
            }
        }
    </script>
@endsection
