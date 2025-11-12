<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Reservas</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #111827; }
        .header { text-align: center; margin-bottom: 12px; }
        h1 { font-size: 20px; margin: 0; color: #0f172a; }
        .meta { font-size: 12px; color: #374151; margin-top: 6px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; font-size: 12px; }
        thead th { background: #0f172a; color: white; padding: 10px; text-align: left; }
        tbody td { padding: 10px; border: 1px solid #e5e7eb; vertical-align: top; }
        tbody tr:nth-child(even) { background: #f8fafc; }
        .small { font-size: 11px; color: #6b7280; }
        .footer { margin-top: 16px; font-size: 11px; color: #6b7280; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Reservas</h1>
        <div class="meta">Generado: {{ date('Y-m-d H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Habitación</th>
                <th>Cliente</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Servicios</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reservas as $r)
            <tr>
                <td> {{ $r->habitacion->numero }} </td>
                <td> {{ $r->cliente->nombre }} </td>
                <td class="small">{{ \Carbon\Carbon::parse($r->fecha_entrada)->format('Y-m-d') }}</td>
                <td class="small">{{ \Carbon\Carbon::parse($r->fecha_salida)->format('Y-m-d') }}</td>
                <td>{{ $r->servicios ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">Sistema de Reservas — {{ date('Y') }}</div>
</body>
</html>
