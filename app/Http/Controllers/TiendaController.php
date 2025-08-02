<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

class TiendaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('productos.imagenes')->get();

        // Obtener productos destacados (puedes ajustar los criterios a tu gusto)
        $destacados = Producto::with('imagenes')
            ->where('destacado', true) // Asegúrate que esta columna existe en la tabla productos
            ->take(10)
            ->get();

        $mas_vendidos = Producto::with('imagenes')->inRandomOrder()->take(10)->get(); // O por lógica de ventas

        return view('tienda.inicio', compact('categorias', 'destacados', 'mas_vendidos'));
    }


    public function categoria($slug)
    {
        $categoria = Categoria::where('slug', $slug)->with('productos.imagenes')->firstOrFail();
        return view('tienda.categoria', compact('categoria'));
    }

    public function producto($slug)
    {
        $producto = Producto::where('slug', $slug)
            ->with(['imagenes', 'variantes.color', 'variantes.talla'])
            ->firstOrFail();

        return view('tienda.producto', compact('producto'));
    }

    public function buscar()
    {
        $query = request('q');

        $resultados = Producto::with('imagenes')
            ->where('nombre', 'like', "%{$query}%")
            ->orWhere('descripcion', 'like', "%{$query}%")
            ->get();

        return view('tienda.buscar', compact('resultados', 'query'));
    }
}
