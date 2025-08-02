<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Color;
use App\Models\Talla;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session()->get('carrito', []);
        return view('tienda.carrito', compact('carrito'));
    }

    public function agregar(Request $request, $producto_id)
    {
        $producto = Producto::findOrFail($producto_id);
        $carrito = session()->get('carrito', []);

        $clave = $producto_id.'-'.$request->color_id.'-'.$request->talla_id;

        if (isset($carrito[$clave])) {
            $carrito[$clave]['cantidad'] += 1;
        } else {
            $carrito[$clave] = [
                'producto_id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
                'color' => Color::find($request->color_id)?->nombre,
                'talla' => Talla::find($request->talla_id)?->etiqueta,
            ];
        }

        session()->put('carrito', $carrito);

        return back()->with('success', 'Producto agregado al carrito.');
    }

    public function eliminar($clave)
    {
        $carrito = session()->get('carrito', []);
        unset($carrito[$clave]);
        session()->put('carrito', $carrito);

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    public function vaciar()
    {
        session()->forget('carrito');
        return back()->with('success', 'Carrito vaciado.');
    }
}
