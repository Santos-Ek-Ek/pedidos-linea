<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 14px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .total { font-weight: bold; text-align: right; margin-top: 10px; }
        .footer { margin-top: 30px; font-size: 12px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Reporte de Pedidos</div>
        <div class="subtitle">
            Del {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} 
            al {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Método de Pago</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->producto->nombre }}</td>
                <td>{{ $pedido->cantidad }}</td>
                <td>${{ number_format($pedido->total * $pedido->cantidad, 2) }}</td>
                <td>{{ $pedido->metodo_pago }}</td>
                <td>{{ \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total General: ${{ number_format($totalGeneral, 2) }}
    </div>

    <div class="footer">
        Generado el: {{ now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html>