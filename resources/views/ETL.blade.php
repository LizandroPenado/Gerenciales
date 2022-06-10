@extends('layouts.app', $usuario)

@section('content')
<div class="container text-center">
    <div class="card card-edit">
        <div class="card-header card-titulo">
            <h2 class="text-white">Procedimiento ETL</h2>
        </div>
        <div class="card-body">
            <p class="info-etl">
                Para iniciar el proceso de Extracción, Transformación y Carga de datos de la base de datos, presione el siguiente botón.
            </p>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Comenzar ETL</button>
        </div>
    </div>
</div>
<div class="container pt-5">
    @if ($resultado != "")
    <div class="alert alert-success text-center" role="alert">
        <h2>{{$resultado}}</h2>
    </div>
    @endif
</div>
<div class="container-fluid container pt-5">
    <div class="text-center">
        <h2 class="">Bítacora de procesos ETL</h2>
    </div>
    <table class="table text-center">
        <thead>
            <tr class="table-info">
                <th>Usuario responsable</th>
                <th>Fecha de realización</th>
                <th>Hora de realización</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody class="table-light table-group-divider">
            @if (count($bitacora) == 0)
            <tr>
                <td colspan="4">No se encuentran registro</td>
            </tr>
            @else
            @foreach($bitacora as $bita)
            <tr>
                <td>{{ $bita->name }}</td>
                <td>{{ $bita->fecha_creacion }}</td>
                <td>{{ $bita->hora_bitacoora }}</td>
                <td>{{ $bita->descripcion_bitacora }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proceso ETL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Una vez iniciado el proceso, no podra realizar ninguna acción, hasta el momento que finalice.
            </div>
            <div class="modal-footer align-self-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a type="submit" class="btn btn-success" href="{{route('ejecucion') }}">Iniciar</a>
            </div>
        </div>
    </div>
    @endsection