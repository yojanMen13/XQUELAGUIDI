<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Recibo de Pedido #{{ $pedido->id }}</h2>
    <p><strong>Cliente:</strong> {{ $pedido->cliente }}</p>
    <p><strong>Teléfono:</strong> {{ $pedido->telefono }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
    <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Color</th>
                <th>Talla</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($pedido->items as $item)
                @php $subtotal = $item->precio * $item->cantidad; $total += $subtotal; @endphp
                <tr>
                    <td>{{ $item->producto->nombre }}</td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->talla }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio, 2) }}</td>
                    <td>${{ number_format($subtotal, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" align="right"><strong>Total:</strong></td>
                <td><strong>${{ number_format($total, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 40px;">Gracias por comprar en XQUELAGUIDI.</p>
</body>
</html>
