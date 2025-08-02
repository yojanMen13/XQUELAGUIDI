<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\VarianteProducto;
use App\Models\Color;
use App\Models\Talla;

class CheckoutController extends Controller
{
    public function whatsapp(Request $request)
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito.index')->withErrors('Tu carrito está vacío.');
        }

        $request->validate([
            'cliente' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
        ]);

        $pedido = Pedido::create([
            'cliente' => $request->cliente,
            'telefono' => $request->telefono,
            'estado' => 'pendiente',
            'whatsapp' => $request->telefono,
        ]);

        foreach ($carrito as $item) {
            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $item['producto_id'],
                'color' => $item['color'],
                'talla' => $item['talla'],
                'cantidad' => $item['cantidad'],
                'precio' => $item['precio'],
            ]);

            VarianteProducto::where('producto_id', $item['producto_id'])
                ->whereHas('color', fn($q) => $q->where('nombre', $item['color']))
                ->whereHas('talla', fn($q) => $q->where('etiqueta', $item['talla']))
                ->decrement('stock', $item['cantidad']);
        }

        session()->forget('carrito');

        $mensaje = "¡Hola! Soy *{$request->cliente}* y quiero realizar un pedido:%0A";

        foreach ($carrito as $item) {
            $mensaje .= "- {$item['nombre']} | Talla: {$item['talla']} | Color: {$item['color']} | Cantidad: {$item['cantidad']}%0A";
        }

        $mensaje .= "%0AMi número de contacto: *{$request->telefono}*%0A%0A¿Podrías confirmarme el total y la forma de pago? ¡Gracias!";

        // Número fijo del negocio (sustituir con el real)
        $numeroTienda = '521XXXXXXXXXX'; // número de WhatsApp de XQUELAGUIDI

        $url = "https://wa.me/$numeroTienda?text=" . $mensaje;

        return redirect()->away($url);
    }
}
