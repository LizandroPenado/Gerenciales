@extends('layouts.app', $usuario)

@section('content')

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
            <form action="{{route('inventario_zonas') }}" method="GET" class="was-validated container-fluid bg-filtros pt-2">
                <div class="p-2 row">
                    <label class="col">Digite el costo</label>
                    <input type="number" class="form-control col" placeholder="10.10" id="costo" name="costo" autocomplete="none" step="0.01" min="0"/>
                </div>
                <div class="p-2 row">
                    <label class="col">Digite la cantidad</label>
                    <input type="number" class="form-control col" placeholder="50" name="cantidad" id="cantidad" autocomplete="none" min="0"/>
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
                        <a class="btn btn-danger" href="{{route('inventario_zonas_pdf') }}">PDF</a>
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
    
@endsection