<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket de Pedido</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 15px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 14px; }
        .info { margin-bottom: 10px; }
        .info strong { display: inline-block; width: 120px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th { background: #f5f5f5; text-align: left; padding: 5px; }
        td { padding: 5px; border-bottom: 1px solid #eee; }
        .text-right { text-align: right; }
        .total { font-weight: bold; font-size: 14px; }
        .footer { margin-top: 20px; font-size: 10px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Comprobante de Pedido</div>
        <div class="subtitle">#{{ $pedidos[0]->id ?? 'N/A' }}</div>
    </div>

    <div class="info">
        <strong>Fecha:</strong> {{ $fecha }}<br>
        <strong>Cliente:</strong> {{ $cliente->name }}<br>
        <strong>Teléfono:</strong> {{ $cliente->telefono }}<br>
        <strong>Dirección:</strong> {{ $cliente->direccion }}<br>
        @if($cliente->referencia_envio)
            <strong>Referencia:</strong> {{ $cliente->referencia_envio }}<br>
        @endif
        <strong>Método entrega:</strong> {{ $metodoEntrega }}<br>
        <strong>Horario:</strong> {{ $horarioEntrega ?? 'A convenir' }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th class="text-right">Precio</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->producto->nombre ?? 'Producto' }}
                    @if($pedido->notas)
                        <br><small>Nota: {{ $pedido->notas }}</small>
                    @endif
                </td>
                <td>{{ $pedido->cantidad }}</td>
                <td class="text-right">${{ number_format($pedido->producto->precio, 2) }}</td>
                <td class="text-right">${{ number_format($pedido->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right">
        <div>Subtotal: ${{ number_format($subtotal, 2) }}</div>
        @if($deliveryCost > 0)
            <div>Costo de envío: ${{ number_format($deliveryCost, 2) }}</div>
        @endif
        <div class="total">Total: ${{ number_format($total, 2) }}</div>
    </div>

    <div class="footer">
        Gracias por su compra!<br>
        Para consultas: gilmereb37@gmail.com<br>
        +52 999 109 6674
    </div>
</body>
</html>