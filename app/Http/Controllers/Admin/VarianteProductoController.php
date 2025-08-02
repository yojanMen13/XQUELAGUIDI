<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VarianteProducto;
use App\Models\Producto;
use App\Models\Color;
use App\Models\Talla;
use Illuminate\Http\Request;

class VarianteProductoController extends Controller
{
    public function store(Request $request, Producto $producto)
    {
        $request->validate([
            'color_id' => 'required|exists:colores,id',
            'talla_id' => 'required|exists:tallas,id',
            'stock' => 'required|integer|min:0',
        ]);

        $existe = VarianteProducto::where('producto_id', $producto->id)
            ->where('color_id', $request->color_id)
            ->where('talla_id', $request->talla_id)
            ->exists();

        if ($existe) {
            return back()->withErrors('Esta combinación ya existe.');
        }

        VarianteProducto::create([
            'producto_id' => $producto->id,
            'color_id' => $request->color_id,
            'talla_id' => $request->talla_id,
            'stock' => $request->stock,
        ]);

        return back()->with('success', 'Variante agregada.');
    }

    public function destroy(VarianteProducto $variante)
    {
        $variante->delete();
        return back()->with('success', 'Variante eliminada.');
    }
}

