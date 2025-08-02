<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('titulo', 'Panel | XQUELAGUIDI')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    @vite('resources/css/admin.css')


</head>

<body>

    <!-- SIDEBAR IZQUIERDA -->
    <div class="sidebar">
        <h4>XQUELAGUIDI</h4>

        {{-- Navegación lateral del panel --}}
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Inicio
        </a>

        <a href="{{ route('admin.productos.index') }}" class="{{ request()->routeIs('admin.productos.*') ? 'active' : '' }}">
            <i class="fas fa-shoe-prints"></i> Productos
        </a>

        <a href="{{ route('admin.colores.index') }}" class="{{ request()->routeIs('admin.colores.*') ? 'active' : '' }}">
            <i class="fas fa-palette"></i> Colores
        </a>

        <a href="{{ route('admin.tallas.index') }}" class="{{ request()->routeIs('admin.tallas.*') ? 'active' : '' }}">
            <i class="fas fa-ruler"></i> Tallas
        </a>

        <a href="{{ route('admin.categorias.index') }}" class="{{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Categorías
        </a>

        <a href="{{ route('admin.pedidos.index') }}" class="{{ request()->routeIs('admin.pedidos.*') ? 'active' : '' }}">
            <i class="fas fa-receipt"></i> Pedidos
        </a>
    </div>

    <!-- ÁREA PRINCIPAL (Topbar + contenido) -->
    <div class="content-wrapper">

        <!-- Topbar superior -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <span class="fw-bold text-secondary">Panel administrativo</span>

            <div>
                @auth
                    <span class="me-3 text-muted">
                        <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-sign-out-alt"></i> Salir
                        </button>
                    </form>
                @endauth
            </div>
        </div>

        <!-- Área de contenido para cada vista -->
        <div class="content">
            @yield('contenido')
        </div>
    </div>

</body>
</html>
