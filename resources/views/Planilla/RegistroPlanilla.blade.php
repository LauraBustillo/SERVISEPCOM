@extends('main')
@section('extra-content')

<style>
    .form-control {
        background-color: transparent;
        border: 1.3px solid #000000;
    }


    .input-group-text {
        background-color: #000000;
        border: 1.3px solid #000000;
        font-family: 'Open Sans';
        color: #FFFFFF;

    }

    .group-text {
        background-color: transparent;
        font-family: 'Open Sans';
        color: #000000;

    }

    /*Letra del titulo del modal */
    .group-texto {
        background-color: transparent;
        font-family: 'Open Sans';
        color: #000000;
        font-size: 25px;
    }

    /*Los titulos */
    .titulo {
        font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
        color: black;
        font-family: 'Open Sans';
        font-size: 20xp;
    }

    /Los botones/ .btn-outline-dark {
        background-color: transparent;
        border: 1.8px solid #000000;
    }

    a {
        color: aliceblue;
        outline: none;
        text-decoration: none;
        color: #000000;
    }

    .a:hover {
        color: white;
    }

    .col1 {
        width: 9%;
    }

    .col2 {
        width: 91%;
    }

    .row {
        display: flex;
        width: 100%;
    }

    .modal-body {
        background-color: rgb(142, 220, 243) !important;
    }

    .modal-header {
        background-color: rgb(184, 234, 249) !important;
    }

    .modal-content {
        background-color: rgb(184, 234, 249) !important;
    }

    .ancho {
        background-color: transparent;
        border: 1.8px solid #000000;
        width: 30%;
    }

    .anchoo {
        background-color: transparent;
        border: 1.8px solid #000000;
        width: 25.8%;
    }

    .box {
        display: flex;
    }

    .select,
    option {
        color: rgb(0, 0, 0);

    }

    .select {
        width: 20%;
        height: 15%;
        margin-left: 0.3%;
        border: 1.8px solid #000000;
        border-radius: 0%;

    }

    div.dataTables_wrapper div.dataTables_filter input {
        display: inline-block;
        width: 100% !important;
        background-color: transparent;
        border: 1.5px solid #5a5858;
        float: left;
        margin-bottom: 5% !important;
    }
    .dataTables_wrapper .dataTables_filter {
        float: left !important ;
        text-align: left !important;
        width: 100% !important;

    } 

    .table-bordered {
        border: 1.8px solid #ffffff;
    }

    .tablaT {
        font: italic normal bold normal 1.2em/1 Helvetica, Arial, sans-serif;
        color: black;
        font-family: 'Open Sans';
    }

</style>


<script>
    var errores = []
  errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!}; 
  if(errores.length > 0){
    errores.forEach(element => {
      alertify.error(element)
    });   
  }
  </script>




<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.1/api/sum().js"></script>

<br>

<script>
    $().ready(function() {
        $('#myTable').DataTable({
            language: {
                "sProcessing": "Procesando..."
                , "sLengthMenu": ""
                , "sZeroRecords": "No se encontraron resultados"
                , "sEmptyTable": ""
                , "sInfo": ""
                , "sInfoEmpty": ""
                , "sInfoFiltered": ""
                , "sInfoPostFix": ""
                , "sSearch": "Buscar por nombre de empleado o número de identidad"
                , "sUrl": "."
                , "sInfoThousands": ""
                , "sLoadingRecords": "Cargando..."
                , "oPaginate": {
                    "sFirst": "Primero"
                    , "sLast": "Último"
                    , "sNext": "Siguiente"
                    , "sPrevious": "Anterior"
                }
                , "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente"
                    , "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
                , "buttons": {
                    "copy": "Copiar"
                    , "colvis": "Visibilidad"
                }
            }

        });



    });
    

</script>




<br>
<br>


<br>
{{-- Título --}}
<H1 class="titulo" style="text-align: center;">Registro de la planilla</H1>

<br>

{{-- Numero de planilla --}}

{{-- Fecha de planilla--}}
<div class="row">
    <div class="col-sm-6">
        <div style="padding-left: 5%  display: flex">
            <b><label class="col-md-3">Fecha Creación</label></b>
            <input type="text" style="display:flex padding-right:50%" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" class="input1 ancho" placeholder="Fecha de la planilla" value="{{ $planilla->fecha_inicio }}">
        </div>
    </div>
    <div class="col-sm-6">
        <div style="padding-left: 5%  display: flex">
        <b><label class="col-md-4">Fecha Finalización</label></b>
            <input type="text" style="display:flex padding-right:50%" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" class="input1 ancho" placeholder="Fecha de la planilla" value="{{ $planilla->fecha_final }}">
        </div>
    </div>
</div>




<br>

<div class="row">
    <div class="col-sm-6">
        <div style="padding-left: 5%  display: flex">
        <b><label class="col-md-3">Dias Trabajados</label></b>

            @php
            $dias_trabajado = 0;

            $primer_dia_mes = Carbon\Carbon::now()->setTimezone('America/Tegucigalpa')->startOfMonth();
            $hoy = Carbon\Carbon::now()->setTimezone('America/Tegucigalpa');

            $filtro = function($date) {
            return true;
            };
            $dias_trabajado = $primer_dia_mes->diffInDaysFiltered($filtro, $hoy);

            @endphp

            <input type="text" style="display:flex padding-right:50%" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" class="input1 ancho" value="{{ $dias_trabajado }}">
        </div>
    </div>
    <div class="col-sm-6">
        <div style="padding-left: 5%  display: flex">
        <b><label class="col-md-4">Horas Trabajados</label></b>
            <input type="text" style="display:flex padding-right:50%" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" class="input1 ancho" value="{{ $dias_trabajado*8 }}">
        </div>
    </div>
</div>


<br>



<div style="display: flex" >


<br><br>
<div style="width: 80%" >
<table class="table table-hover table-bordered" id='myTable'>
    <thead>
        <tr>
            <th class="tablaT" colspan="12" style="text-align: center;">Detalles de la planilla laboral</th>
        </tr>
        <tr>
            <th colspan="7"></th>
            <th colspan="2" style="text-align: center;">Horas extras (Diurnas) 1.2%</th>
            <th colspan="2" style="text-align: center;">Horas extras (Nocturnas) 1.5%</th>



        </tr>

        <tr>
            <th style="text-align: center">Nombre</th>
            <th style="text-align: center">Identidad</th>
            <th style="text-align: center">Teléfono</th>
            <th style="text-align: center">Sueldo Base</th>
            <th style="text-align: center">Dias No Trabajados</th>
            <th style="text-align: center">Horas trabajadas</th>
            <th style="text-align: center">Salario/h</th>
            <th style="text-align: center">Horas</th>
            <th style="text-align: center">Valor/h</th>
            <th style="text-align: center">Horas</th>
            <th style="text-align: center">Valor/h</th>
            <th style="text-align: center">Sueldo Neto</th>
        </tr>

    </thead>

    <tbody>
        @php
        $total_planillas = 0;
        @endphp
        @foreach ($planilla->planilla_detalle as $detalle)
        <tr>
            <td style="text-align: center">{{ $detalle->empleado->Nombres.' '.$detalle->empleado->Apellidos }}</td>
            <td style="text-align: center">{{ $detalle->empleado->Numero_identidad }}</td>
            <td style="text-align: center">{{ $detalle->empleado->Numero_telefono }}</td>
            <td style="text-align: right">{{ 'L.' .number_format( $detalle->empleado->Salrio,2) }}</td>
            <td style="text-align: center;">
                <center>
                    <form action="{{ route('put.planilla.dias') }}" method="POST"  id="{{ 'formulario'.$detalle->id  }}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="id_detalle" value="{{ $detalle->id }}" hidden>
                        <input type="text" name='no_trabajo'  maxlength="2" class="form-control" style="width: 100px" value="{{ $detalle->no_trabajados }}" onchange="agregar_id('{{ 'formulario'.$detalle->id  }}')">
                       
                    </form>
                </center>
            </td>
            <td style="text-align: center">{{ ($dias_trabajado*8)-($detalle->no_trabajados*8) }}</td>
            <td style="text-align: right">{{ 'L.' .number_format($detalle->salario_hora,2) }}</td>
            <td style="text-align: center;">
                <center>
                    <form action="{{ route('put.planilla.hora_diurnas') }}" method="POST" id="{{ '2formulario'.$detalle->id  }}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="id_detalle" value="{{ $detalle->id }}" hidden>
                        <input type="text" name='no_trabajo'  maxlength="2" class="form-control" style="width: 100px" value="{{ $detalle->horas_diurnas }}" onchange="agregar_id('{{ '2formulario'.$detalle->id  }}')">
                    </form>
                </center>
            </td>
            <td style="text-align: center">{{ 'L.' .number_format($detalle->salario_hora*1.2,2) }}</td>
            <td style="text-align: center;">
                <center>
                    <form action="{{ route('put.planilla.hora_nocturna') }}" method="POST" id="{{ '3formulario'.$detalle->id  }}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="id_detalle" value="{{ $detalle->id }}" hidden>
                        <input type="text" name='no_trabajo'  maxlength="3" class="form-control" style="width: 100px" value="{{ $detalle->horas_nocturnas }}" onchange="agregar_id('{{ '3formulario'.$detalle->id  }}')">
                    </form>
                </center>
            </td>
            <td style="text-align: center">{{ 'L.' .number_format($detalle->salario_hora*1.5,2) }}</td>
            @php
            $sueldo_neto = 0;
            $horas_trabajadas = ($dias_trabajado*8)-($detalle->no_trabajados*8);

            $sueldo_neto = ($horas_trabajadas * $detalle->salario_hora) + ($detalle->horas_diurnas*($detalle->salario_hora*1.2)) + ($detalle->horas_nocturnas*($detalle->salario_hora*1.5));

            $total_planillas += $sueldo_neto ;
            @endphp
            <td style="text-align: right">{{ 'L.' .number_format($sueldo_neto,2) }}</td>
        </tr>

        @endforeach
    </tbody>
<tfoot>
    <tr>
        <th colspan="8"></th>
        <th colspan="2">Total planilla</th>
        <th colspan="2" style="text-align: right">{{ 'L.' .number_format($total_planillas,2) }}</th>
    </tr>
</tfoot>
</table>
</div>

<div style=" width: 20%" >
    <form action="" id="formulario_calcular" >
        <br>
        <button class="btn btn-outline-dark" type="submit" onclick="enviarFormulario()"><i class="bi bi-calculator-fill"> Calcular planilla</i></button>
    </form>

    </div>
</div>

{{--Botones --}}
<br>
<center class="form-inline">
    @if($planilla->fecha_final == $planilla->fecha_inicio )
        <button class="btn btn-outline-dark" type="submit" onclick="guardar_planilla()"> <i class="bi bi-folder-fill"> Guardar</i></button>
    @endif
    <button type="submit" class="btn btn-outline-dark" onclick="recrear_planilla()"> <i class="bi bi-trash3-fill"> Eliminar planilla</i></button>
    <button type="button" class="btn btn-outline-dark"><a class="a" href="{{route('index.planilla')}}"><i class="bi bi-x-circle-fill"> Cerrar</i> </a></button>
</center>


<form action="{{ route('delete.planilla', ['id'=>$planilla->id]) }}" method="POST" id="formulario_elimina">
    @csrf
    @method('DELETE')
</form>


@if($planilla->fecha_final == $planilla->fecha_inicio )
<form action="{{ route('guardar.planilla', ['id'=>$planilla->id]) }}" method="POST" id="formulario_guardar">
    @csrf
    <input type="hidden"  name="total_planilla" value="{{ $total_planillas }}">
</form>
@endif




@endsection
@include('common')

@push('scripstss')
<script>

    let id_formularios = [];


    function agregar_id(formId) {4
        id_formularios.push(formId);

        const sinRepetidos = id_formularios.filter((elemento, indice, arreglo) => {
            return arreglo.indexOf(elemento) === indice;
        });


    }

    function enviarFormulario() {

       
        event.preventDefault();
        id_formularios.map((id) => {
            var form = document.getElementById(id);
            var formData = new FormData(form);

            $.ajax({
                url: form.action,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });


    }

    function formulario(params) {
        if (event.keyCode == 13) {
            document.getElementById(params).submit()
        }
    }

    function recrear_planilla() {
        var formul = document.getElementById("formulario_elimina");

        Swal.fire({
            title: '¿Está seguro que desea eliminar los datos de la planilla?'
            , icon: 'question'
            , confirmButtonColor: '#3085d6'
            , showCancelButton: true
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Si'
            , cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                formul.submit();
            }
        })
        event.preventDefault()
    }

    @if($planilla-> fecha_final == $planilla-> fecha_inicio)

    function guardar_planilla() {
        var formul = document.getElementById("formulario_guardar");

        Swal.fire({
            title: '¿Está seguro que desea guardar los datos?'
            , icon: 'question'
            , confirmButtonColor: '#3085d6'
            , showCancelButton: true
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Si'
            , cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                formul.submit();
            }
        })
        event.preventDefault()
    }
    @endif

</script>
@endpush
