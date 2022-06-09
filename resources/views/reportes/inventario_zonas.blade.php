<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inventario</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('principal.css') }}" />

    <!-- Boostrap-->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <!-- JSGrid-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>

</head>

<body class="logo-fondo">
    <div class="text-center pt-3 text-primary">
        <h1 class="titulo-reporte">Reporte de inventario de especies por zona</h1>
    </div>
    <div class="row text-center pt-3 container-fluid">
        <div class="col-sm-7">
            <div class="text-center">
                <img src="zona.png" class=" imagen-zona" />
            </div>
        </div>
        <div class="col-sm-5 align-self-center">
            <h3>Filtros</h3>
            <form action="{{route('inventario_zona') }}" method="GET" class="container-fluid bg-filtros pt-2">
                <div class="p-2 row">
                    <label class="col">Digite el costo</label>
                    <input type="text" class="form-control col" placeholder="10.10" id="costo" name="costo" autocomplete="none" />
                </div>
                <div class="p-2 row">
                    <label class="col">Digite la cantidad</label>
                    <input type="text" class="form-control col" placeholder="50" name="cantidad" id="cantidad" autocomplete="none" />
                </div>
                <div class="p-2 row">
                    <label class="col">Selecciones la zona</label>
                    <select class="form-select col" name="zona_id" id="zona_id">
                        <option value="" id="">Selecione la zona...</option>
                        @foreach($zona as $zon)
                        <option value="{{ $zon->id }}" id="{{ $zon->id }}" name="{{ $zon->id }}">{{ $zon->nombre_zona }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="p-2 row">
                    <label class="col">Selecciones la comparación</label>
                    <select class="form-select col" name="comparacion" id="comparacion">
                        <option value="Mayor" id="Mayor">Mayor o igual</option>
                        <option value="Menor" id="Meno">Menor o igual</option>
                    </select>
                </div>
                <div class="p-2 row">
                <div class="col">
                        <button class="btn btn-danger ">PDF</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div class="container-fluid container pt-3">
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
    <!--  <div class="container-fluid container pt-3">
        <div class="pt-3" id="grid_table">

        </div>
    </div> -->
</body>

</html>

<script type="text/javascript">
    /*  $('#grid_table').jsGrid({

        width: "100%",
        height: "100%",

        //filtering: true,
        sorting: true,
        paging: true,
        //autoload: true,
        pageSize: 10,
        pageButtonCount: 5,
        data: @json($inventario),


        fields: [{
                name: "nombre",
                type: "text",
            },
            {
                name: "costo",
                type: "text",
            },
            {
                name: "valorVenta",
                type: "text",
                validate: function(value) {
                    if (value > 0) {
                        return true;
                    }
                }
            },
            {
                name: "cantidad",
                type: "text",
            },
            {
                name: "estado",
                type: "text",
                validate: function(value) {
                    if (value > 0) {
                        return "Inventario";
                    }
                    return "No inventario"
                }
            },
             {
                 type: "control",
                 modeSwitchButton: false,
                 editButton: false,
                 deleteButton: false
             }
        ]
    }); */
</script>