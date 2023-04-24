@extends('main')
@section('extra-content')
<style>
    .input-group-text {
        background-color: #B8D7F9;
        border: 1.5px solid #000000;
    }

    .form-control {
        background-color: transparent;
        border: 1.5px solid #000000;
    }

    .table-1 {
        width: 100%;
        color: rgb(3, 10, 1);
        border: 1px solid #000000;

    }

    .table-1 th {
        background-color: #0319C4;
        color: white;
        padding: .2rem;
        text-align: start;
    }

    .btn-info {
        background-color: transparent;
        border: 1px solid #000000;
    }

    /*Los titulos */
    .titulo {
        font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
        color: black;
        font-family: 'Open Sans';
        font-size: 20xp;
    }

    /*Los botones*/
    .btn-outline-dark {
        background-color: transparent;
        border: 1.8px solid #000000;
        text-decoration: none;
        color: black;

    }

    /*Quitar subrayado*/
    a:link,
    a:visited,
    a:active,
    a:focus {
        text-decoration: none;
        Color: black;

    }

    div.dataTables_wrapper div.dataTables_filter input {


width: 80% !important;
background-color: transparent;
border: 1.5px solid #000000;
float: left;

margin-bottom: 5%;
}



.dataTables_wrapper .dataTables_filter {
float: left !important ;
text-align: left !important;
width: 100% !important;

}

/*Para las tablas*/ 
.bordeTabla{
border:solid black 1px;
                 
} 

table {    
                
   border: 1px solid black;
   right:solid black 5px;   
  }     
th {
 border-top:solid black 1px;
}    
td {
 border-right:solid black 0.1px;
} 


 
    div.container {
        width: 80%;
      
    }

 
#padre{
  position: relative;
  background-color: transparent;
}

#uno {
  position: absolute;
  background-color: transparent;
  top: 22%;
  left: 62.5%;
  right: 0;
  margin: 0 auto;
  width: 5px;
}
html, body {
    width: 100% !important;
}


</style>



@if (session('mensaje'))
  <script>
    mensaje = {!! json_encode(session('mensaje'), JSON_HEX_TAG) !!};
    alertify.success(mensaje);
  </script> 
@endif 

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

<script  src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script  src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script  src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
<script  src="https://cdn.datatables.net/plug-ins/1.13.1/api/sum().js"></script>

{{--Para los reportes--}}

<script  src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

<script  src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script  src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

{{-- Darle forma a los borones de reporte--}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<br>


<script>
    $().ready(function() {
        $('#myTable').DataTable({
            'pageLength': 5,
            language: {
                'pageLength': 5,
                "sProcessing": "Procesando..."
                , "sLengthMenu": ""
                , "sZeroRecords": "No se encontraron resultados"
                , "sEmptyTable": ""
                , "sInfo": ""
                , "sInfoEmpty": ""
                , "sInfoFiltered": ""
                , "sInfoPostFix": ""
                , "sSearch": '<b>Buscar por número de pedido</b>'
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

    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values


    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {


            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[3]);

            if ( 
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );

    $(document).ready(function() {
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'YYYY - M - DD'
        });
        maxDate = new DateTime($('#max'), {
            format: 'YYYY - M - DD'


        });

        // DataTables initialisation

        var table = $('#myTable').DataTable();

        // Refilter the table
        $('#min, #max').on('change', function() {
            table.draw();


        });
    });

</script>



<h1 class="titulo" style="text-align:center">Listado de devoluciones</h1>



<div class="input-group "  style="display: flex" ><br>
  <div style="width: 20%" >
  <b><label for="" class="group-text">Fecha minima:</label></b>
  <input  class="form-control" id="min" name="min" value=""> 
  </div> &nbsp;&nbsp;
  
  <div style="width: 20%">
    <b><label for="" class="group-text">Fecha  máxima:</label></b>
    <input   class="form-control" id="max" name="max" value="" > 
  </div> &nbsp;&nbsp;

  <div style="width: 6%"><br>
  <a href="{{ route('devolucion.index') }}" class="btn btn-outline-dark"><i class="bi bi-trash3-fill"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
  </div>&nbsp;&nbsp;
  
  <div style="width: 49%"><br>
  <a class="btn btn-outline-dark" style="float:right" href="{{route('show.devolucion')}}">
  <i class="bi bi-plus-square-fill"></i></i></a>
  </div>
</div>
<div > 
 



    <table class="table table-striped table-hover  border-dark bordeTabla"  id="myTable"  style="width: 100%"  >


        <thead class="table-dark" >
            <tr>
                <th scope="col">Nombre del producto en devolución</th>
                <th scope="col">Número de factura</th>
                <th scope="col">Fecha recibido</th>
                <th scope="col">Fecha de devolución</th>
                <th scope="col" style="text-align: center;">Estado</th>
                <th scope="col"  style="text-align: center;">Detalles</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($devoluciones as $devolucion)
            <tr>
                <td>{{ $devolucion->producto->Nombre_producto }}</td>
                <td>{{ $devolucion->detalle_venta->Numero_facturaform }}</td>
                <td>{{ $devolucion->Fecha_devolucion }}</td>
                <td>{{ $devolucion->Fecha_devolucion }}</td>
                <td>{{ $devolucion->estado_devolucion }}</td>
                <td style="text-align: center;">
                    <a class="btn-detalles" href="{{route('devolucion.mostrar',[ $devolucion->id ]) }}">
                    <i class="bi bi-info-circle-fill"></i>
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</div>




@endsection
@include('common')