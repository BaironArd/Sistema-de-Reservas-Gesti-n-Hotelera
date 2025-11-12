<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Habitaciones</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #111827; }
        .header { text-align: center; margin-bottom: 12px; }
        .logo { width: 80px; height: auto; }
        h1 { font-size: 20px; margin: 0; color: #0f172a; }
        .meta { font-size: 12px; color: #374151; margin-top: 6px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; font-size: 12px; }
        thead th { background: #0f172a; color: white; padding: 10px; text-align: left; }
        tbody td { padding: 10px; border: 1px solid #e5e7eb; }
        tbody tr:nth-child(even) { background: #f8fafc; }
        .footer { margin-top: 16px; font-size: 11px; color: #6b7280; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        {{-- opcional: <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo"> --}}
        <h1>Reporte de Habitaciones</h1>
        <div class="meta">Generado: {{ date('Y-m-d H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Número</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($habitaciones as $h)
            <tr>
                <td>{{ $h->numero }}</td>
                <td>{{ $h->tipo }}</td>
                <td>${{ number_format($h->precio, 0, ',', '.') }}</td>
                <td>{{ $h->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">Sistema de Reservas — {{ date('Y') }}</div>
</body>
</html>
