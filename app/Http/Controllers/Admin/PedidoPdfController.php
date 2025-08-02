<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Barryvdh\DomPDF\Facade\Pdf;

class PedidoPdfController extends Controller
{
    public function descargar(Pedido $pedido)
    {
        $pedido->load('items.producto');

        $pdf = Pdf::loadView('admin.pedidos.recibo', compact('pedido'));

        return $pdf->download("pedido_{$pedido->id}.pdf");
    }
}
