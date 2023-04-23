@extends('main')
@section('extra-content')

<style>
.input-group-text  {
  background-color: #B8D7F9;
  border: 1px solid #0319C4;
}

.form-control  {
    background-color: transparent;
    border: 1px solid #0319C4;
}

.btn-info{
    background-color: transparent;
    border: 1px solid #0319C4;
}
.dt-buttons{
  padding-left: 100% !important;


}
.dt-button{

  padding: 0 !important;
  border: none !important;
}


/*Los titulos */ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #4c4d4e;
  font-family: 'Open Sans';
  font-size: 20px;
}
/*Los titulos */ 
.titulo1 {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #4c4d4e;
  font-family: 'Open Sans';
  font-size: 40px;
  text-align: center;
}

.button {
    border-bottom: 1px solid hsla(0, 0%, 100%, 0);
    text-shadow: 0 1px 0 hsla(0, 0%, 0%, 0);
    text-decoration: none !important;
    text-transform: uppercase;
    color: #fff !important;
    font-weight: bold;
    border-radius: 5px;
    padding: 10px 20px;
    margin: 0 3px;
    position: relative;
    display: inline-block;
    -webkit-transition: all 0.1s;
    -moz-transition: all 0.1s;
    -o-transition: all 0.1s;
    transition: all 0.1s;
}
.button:active {
    -webkit-transform: translateY(7px);
    -moz-transform: translateY(7px);
    -o-transform: translateY(7px);
    transform: translateY(7px);
}

.button-blue {
    background: #4c4d4e;
    box-shadow: 0 5px 0 #161616,
                0 11px 5px hsla(0, 0%, 0%, 0.5);
}
.button-blue:active {
    box-shadow: 0 3px 0 #161616,
                0 4px 6px hsla(0, 0%, 0%, 0.7);
}

.boton1{
  border: none;
}
.button-blue {
    background: #4c4d4e;
    box-shadow: 0 5px 0 #161616,
                0 11px 5px hsla(0, 0%, 0%, 0.5);
}

.nota {
  font-family: inherit;
  -webkit-text-fill-color: black;
-webkit-text-stroke: 1px  black;
font-size: 20px;
}

    </style>

    
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>


<script  src = 'build/pdfmake.min.js' ></script>
<script  src = 'build/vfs_fonts.js' ></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

<script  src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script  src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script  src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
<script  src="https://cdn.datatables.net/plug-ins/1.13.1/api/sum().js"></script>

{{--Para los reportes--}}

<script  src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script  src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

<script  src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script  src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>


{{-- Darle forma a los borones de reporte--}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<script>

$(document).ready(function(){
    $('#table2').DataTable({
    dom:  '<"wrapper"Blitp>',
'pageLength': 30,
language:{ "sProcessing": "Procesando...",
    "sLengthMenu": "",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "",
    "sInfo": "",
    "sInfoEmpty": "",
    "sInfoFiltered": "",
    "sInfoPostFix": "",
    "sSearch": "Buscar por nombre del producto, marca o categoría",
    "sUrl": ".",
    "sInfoThousands": "",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
    }
},
fixedHeader: {
                    header: true,
                    footer: true
                },

buttons: [
        {
            
        extend: 'print', footer: true,
        text:  '<button class ="btn btn-secondary" > <i class="fa fa-print" ></i></button>',
        titleAttr: 'Imprimir',
        title:'REPORTE DE INFORMACIÓN DE PLANILLA',
        messageTop:
        '___________________________________________________________________________________________________________________________________________________________________'+'<br>' + 
        'Fecha de creación:                    '+  '{{  $planillaI->fecha_inicio }}'+ '<br>' +
        'Fecha Finalización:                   '+  '{{   $planillaI->fecha_final }}'+ '<br>' +
        '___________________________________________________________________________________________________________________________________________________________________'+'<br>' , 

        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },

    
       
          customize: function ( win ) {
                        $(win.document.body).find('h1').css('text-align', 'center');
                        $(win.document.body).css( 'font-size', '15px' ) .css( 'font-weight', 'bolder' ) .css('color',  '2f3287');
                        $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                    
                        .css( 'font-size', 'inherit' );
},
       
      },
      
    
       
]

 });
});

 </script>

<h1 class="titulo1">Información de la planilla</h1>
<br>
 

 <div>
 <table class="table table-hover" id="example1" style="width:100%">
        <thead>
            <tr>
                <th>Datos</th>
                <th>Información</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Fecha de creación</td>
                <td>{{ $planillaI->fecha_inicio }}</td>

            </tr>

            <tr>
                <td>Fecha Finalización</td>
                <td>{{ $planillaI->fecha_final }}</td>

            </tr>


        </tbody>
    </table>

  <br>


<table class="table table-striped table-hover  border-dark bordeTabla" id="table2"  style="width:100%">

    <thead >
        <tr>
            <th>Nombre</th>
            <th>Identidad</th>
            <th>Teléfono </th>
            <th>Sueldo base</th>
            <th>Días no trabajados </th>
            <th>Horas trabajadas </th>
            <th>Salario/H</th>
            <th>Horas E/D</th>
            <th>Valor/H</th>
            <th>Horas E/N</th>
            <th>Valor/H</th>
            <th>Sueldo neto</th>
        </tr>
        <tbody>
            @php
            $total_planillas = 0;
            @endphp
            @foreach ($planillaDetalle as $detalle)
            <tr>
                <td style="text-align: center">{{ $detalle->empleado->Nombres.' '.$detalle->empleado->Apellidos }}</td>
                <td style="text-align: center">{{ $detalle->empleado->Numero_identidad }}</td>
                <td style="text-align: center">{{ $detalle->empleado->Numero_telefono }}</td>
                <td style="text-align: right">{{ 'L.' .number_format( $detalle->empleado->Salrio,2) }}</td>
                <td style="text-align: center;">{{ $detalle->no_trabajados }}</td>
                <td style="text-align: center">{{ (30*8)-($detalle->no_trabajados*8) }}</td>
                <td style="text-align: right">{{ 'L.' .number_format($detalle->salario_hora,2) }}</td>
                <td style="text-align: center;">{{ $detalle->horas_diurnas }}</td>
                <td style="text-align: center">{{ 'L.' .number_format($detalle->salario_hora*1.2,2) }}</td>
                <td style="text-align: center;">{{ $detalle->horas_nocturnas }} </td>
                <td style="text-align: center">{{ 'L.' .number_format($detalle->salario_hora*1.5,2) }}</td>
                @php
                $sueldo_neto = 0;
                $horas_trabajadas = (30*8)-($detalle->no_trabajados*8);

                $sueldo_neto = ($horas_trabajadas * $detalle->salario_hora) + ($detalle->horas_diurnas*($detalle->salario_hora*1.2)) + ($detalle->horas_nocturnas*($detalle->salario_hora*1.5));

                $total_planillas += $sueldo_neto ;
                @endphp
                <td style="text-align: right">{{ 'L.' .number_format($sueldo_neto,2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>

            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: right"></td>
            <td style="text-align: center;"></td>
            <td style="text-align: center"></td>
            <td style="text-align: right"></td>
            <td style="text-align: center;"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center;"></td>
            <td style="text-align: center">Total planilla</td>
            <td style="text-align: right">{{ 'L.' .number_format($total_planillas,2) }}</td>
        </tfoot>
    </thead>
  </table>

</div>
<label style="padding-left:% " class="nota">
<b> Nota informativa de la planilla. &nbsp; &nbsp; 
H = Horas &nbsp;  
  E/D = Extras/Diurna &nbsp;  
E/N = Extras/Nocturnas</b> 
</label>
<br><br><br>
    <a class="button button-blue " href="{{ route('index.planilla') }}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>


@endsection
@include('common')
