<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\VarianteProductoController;
use App\Http\Controllers\Admin\ImagenProductoController;
use App\Http\Controllers\Admin\PedidoController;
use App\Http\Controllers\Admin\PedidoPdfController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\TallaController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CheckoutController;

// 🛒 Tienda pública
Route::get('/', [TiendaController::class, 'index'])->name('tienda.inicio');
Route::get('/categoria/{slug}', [TiendaController::class, 'categoria'])->name('tienda.categoria');
Route::get('/producto/{slug}', [TiendaController::class, 'producto'])->name('tienda.producto');
Route::get('/buscar', [TiendaController::class, 'buscar'])->name('tienda.buscar');


// 🧺 Carrito
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::delete('/carrito/eliminar/{clave}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

// ✅ Checkout
Route::post('/checkout', [CheckoutController::class, 'whatsapp'])->name('checkout');

// 🔐 Panel administrativo
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

    // CRUD productos y categorías
    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class);

    // Imágenes
    Route::post('productos/{producto}/imagenes', [ImagenProductoController::class, 'store'])->name('imagenes.store');
    Route::put('imagenes/{imagen}', [ImagenProductoController::class, 'update'])->name('imagenes.principal');
    Route::delete('imagenes/{imagen}', [ImagenProductoController::class, 'destroy'])->name('imagenes.destroy');

    // Variantes
    Route::post('productos/{producto}/variantes', [VarianteProductoController::class, 'store'])->name('variantes.store');
    Route::delete('variantes/{variante}', [VarianteProductoController::class, 'destroy'])->name('variantes.destroy');

    // Pedidos
    Route::get('pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('pedidos/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');
    Route::put('pedidos/{pedido}', [PedidoController::class, 'update'])->name('pedidos.update');
    Route::get('pedidos/{pedido}/pdf', [PedidoPdfController::class, 'descargar'])->name('pedidos.pdf');

    // Colores y Tallas
    Route::resource('colores', ColorController::class)->except(['show']);
    Route::resource('tallas', TallaController::class)->except(['show']);
});

// 👤 Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth scaffolding
require __DIR__ . '/auth.php';
