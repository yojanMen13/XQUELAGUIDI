<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImagenProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenProductoController extends Controller
{
    public function store(Request $request, Producto $producto)
    {
        $request->validate([
            'imagen' => 'required|image|max:2048',
        ]);

        $ruta = $request->file('imagen')->store('imagenes_productos', 'public');

        $producto->imagenes()->create([
            'url' => $ruta,
            'principal' => false,
        ]);

        return back()->with('success', 'Imagen agregada correctamente.');
    }

    public function update(ImagenProducto $imagen)
    {
        // Marcar como principal y desmarcar las demás
        ImagenProducto::where('producto_id', $imagen->producto_id)
            ->update(['principal' => false]);

        $imagen->update(['principal' => true]);

        return back()->with('success', 'Imagen marcada como principal.');
    }

    public function destroy(ImagenProducto $imagen)
    {
        Storage::disk('public')->delete($imagen->url);
        $imagen->delete();

        return back()->with('success', 'Imagen eliminada.');
    }
}
