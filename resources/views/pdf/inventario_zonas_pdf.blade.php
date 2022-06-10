<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reporte</title>

    <script src="{{ public_path('js/app.js') }}" defer></script>
    <link type="text/css" rel="stylesheet" href="{{ public_path('principal.css') }}" />
    <link type="text/css" href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="text-center bg-filtros pt-2">
        <div class="row">
            <div class="col">
                <img src="logo.jpg" class="logo-reporte" />
            </div>
            <div class="col">
                <p class="entidad">ALCALDIA MUNICIPAL DE SOYAPANGO</p>
            </div>
        </div>
    </div>
    <div class="pt-3 text-center">
        <p class="titulo-reporte">Reporte de inventario de especies por zonas</p>
    </div>


    <div class="pt-3">
        <table class="table text-center">
            <thead>
                <tr class="table-info">
                    <th>Nombre</th>
                    <th>Costo</th>
                    <th>Valor de venta</th>
                    <th>Cantidad</th>
                    <th>Inventario</th>
                    <th>Zona</th>
                </tr>
            </thead>
            <tbody class="table-light table-group-divider">
                @if (count($inventario) == 0)
                <tr>
                    <td colspan="6">No se encuentran registro</td>
                </tr>
                @else
                @foreach($inventario as $inven)
                <tr>
                    <td>{{ $inven->nombre_especie }}</td>
                    <td>$ {{ $inven->costo_especie }}</td>
                    <td>$ {{ $inven->valorVenta }}</td>
                    <td>{{ $inven->cantidad_especie }}</td>
                    <td>{{ $inven->nombre_inventario }}</td>
                    <td>{{ $inven->nombre_zona }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>