<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\VarianteProducto;
use App\Models\ImagenProducto;
use Illuminate\Support\Facades\Storage;


class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'color_id' => 'required|exists:colores,id',
        'talla_id' => 'required|exists:tallas,id',
        'stock' => 'required|integer|min:0',
    ]);

    // 1. Crear producto
    $producto = Producto::create([
        'nombre' => $request->nombre,
        'slug' => Str::slug($request->nombre),
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'categoria_id' => $request->categoria_id,
        'activo' => true,
    ]);

    // 2. Subir imagen principal
    if ($request->hasFile('imagen')) {
        $ruta = $request->file('imagen')->store('productos', 'public');

        ImagenProducto::create([
            'producto_id' => $producto->id,
            'url' => $ruta,
            'principal' => true,
        ]);
    }

    // 3. Guardar variante inicial
    VarianteProducto::create([
        'producto_id' => $producto->id,
        'color_id' => $request->color_id,
        'talla_id' => $request->talla_id,
        'stock' => $request->stock,
    ]);

    return redirect()->route('admin.productos.index')->with('success', 'Producto creado correctamente.');
}

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $producto->update([
            'nombre' => $request->nombre,
            'slug' => Str::slug($request->nombre),
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado.');
    }
}
