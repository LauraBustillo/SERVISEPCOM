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

        display: inline-block;
        width: 120% !important;
        background-color: transparent;
        border: 1.5px solid #000000;
        float: left;
    }

    .dataTables_wrapper .dataTables_filter {
        float: left !important;
        text-align: left !important;
        width: 100% !important;

    }
    .dt-buttons{
    padding-left: 85% !important;

    }
    .dt-button{
    padding: 0 !important;
    border: none !important;
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.1/api/sum().js"></script>

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
    $().ready(function(){
        $('#myTable').DataTable({

        dom:  '<"wrapper"fBlitp>',
        language:{ "sProcessing": "Procesando...",
            "sLengthMenu": "",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "",
            "sInfo": "",
            "sInfoEmpty": "",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Búsqueda general",
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

            buttons: [

                    //Imprimir

                    {
                        extend:    'print',
                        text:  '<button class ="btn btn-secondary" > <i class="fa fa-print" ></i></button>',
                        titleAttr: 'Imprimir',
                        title:'Reporte de listado de planilla '
                    },


                    //PDF
                    {
                            extend: 'pdfHtml5',
                            text:  '<button class ="btn btn-danger" > <i class="fa fa-file-pdf-o"></i></button>',
                            titleAttr: 'Archivo PDF',
                            orientation: 'portrait',
                            pageSize: 'A4',
                            title:'Reporte de listado de planilla',
                            exportOptions: { columns: [0, 1, 2] },

                        customize: function(doc) {
                        doc.content[1].margin =[100, 0, 100, 0] ,
                        doc.content.splice(1, 0, {
                            columns: [{ }],
                            });

                            doc['footer'] = (function(page, pages) {
                                    return {
                                    columns: [
                                        {
                                        alignment: 'center',
                                        text: [
                                            { text: page.toString(), italics: true },
                                ' / ',
                                            { text: pages.toString(), italics: true }
                                ]
                                    }],
                                    margin: [10, 0]
                                    }
                                });

                        }
                    },

                    {
                    extend:    'excelHtml5',
                    text:       '<button class ="btn btn-success" > <i class="fa fa-file-excel-o"></i></button>',
                    titleAttr: 'Archivo Excel',
                    exportOptions: { columns: [0, 1, 2] }

                    },

            ]

        });


    });


</script>



<h1 class="titulo" style="text-align:center">Listado de planilla</h1>

<br>

<div class="input-group " style="padding-right:4%" style="width: 100%"><br>

    <div><br>&nbsp; &nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="btn btn-outline-dark" style="float:right" href="{{route('show.registroPlanilla')}}">
            @if($continuar)
            <i class="bi bi-person-plus-fill"> Continuar planilla </i></a>
        @else
        <i class="bi bi-person-plus-fill"> Nueva planila </i></a>
        @endif


    </div>

</div>
<br>
<div>

    <table id='myTable' class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Número de planilla</th>
                <th scope="col">Fecha de la planilla</th>
                <th scope="col">Total de planilla en general</th>
                <th scope="col">Detalles de la planilla</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($listaPlanillas as $planilla)
            <tr>
                <td>{{ $planilla->id }}</td>
                <td>{{ $planilla->fecha_final }}</td>
                <td>{{ $planilla->total_pagar }}</td>
                <td>
                    <a class="btn-detalles" >
                        <i class="bi bi-file-text-fill"> Ver detalle </i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>






@endsection
@include('common')
