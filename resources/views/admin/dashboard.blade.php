@extends('layouts.admin')

@section('titulo', 'Dashboard')

@section('contenido')
    {{-- Título de bienvenida --}}
    <div class="mb-4">
        <h2 class="fw-bold text-dark">Bienvenido al Panel Administrativo</h2>
        <p class="text-muted">Gestiona productos, pedidos y configuración de tu tienda <strong>XQUELAGUIDI</strong>.</p>
    </div>

    {{-- Tarjetas de acceso rápido --}}
    <div class="row g-4">
        {{-- Productos --}}
        <div class="col-md-4">
            <a href="{{ route('admin.productos.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 hover-shadow transition">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-shoe-prints fa-2x text-primary mb-3"></i>
                        <h5 class="card-title text-dark">Productos</h5>
                        <p class="text-muted small">Administra tu catálogo de huaraches.</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Categorías --}}
        <div class="col-md-4">
            <a href="{{ route('admin.categorias.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 hover-shadow transition">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-tags fa-2x text-secondary mb-3"></i>
                        <h5 class="card-title text-dark">Categorías</h5>
                        <p class="text-muted small">Organiza los productos por tipo y público.</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Pedidos --}}
        <div class="col-md-4">
            <a href="{{ route('admin.pedidos.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 hover-shadow transition">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-receipt fa-2x text-success mb-3"></i>
                        <h5 class="card-title text-dark">Pedidos</h5>
                        <p class="text-muted small">Consulta y gestiona los pedidos realizados.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
