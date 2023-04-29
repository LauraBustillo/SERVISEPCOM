@extends('main')
@section('extra-content')
<style>

.form-control  {
    background-color: transparent;
    border: 1.5px solid #000000;
}

/*Los titulos */ 
.titulo {
  font: italic normal bold normal 2.5em/1 Helvetica, Arial, sans-serif;
  color: black;
  font-family: 'Open Sans';
  font-size: 45px;
}

/*Los botones*/ 
.btn-outline-dark {
  background-color: transparent;
  border: 1.8px solid #000000;
  text-decoration: none;
  color: black;
  
} 

/*Quitar subrayado*/ 
 a:link, a:visited, a:active, a:focus{
    text-decoration:none;
    Color: black; 
   
  }

  div.dataTables_wrapper div.dataTables_filter input {

  display: inline-block;
  width: 100% !important;
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
                
   border: 5px solid black;
   right:solid black 5px;   
  }     
th {
 border-top:solid black 1px;
}    
td {
 border-right:solid black 0.1px;
} 

table.dataTable.dataTable_width_auto {
  width: auto;
}

 
    div.container {
        width: 100% !important;
        height: 100% !important;
        padding-left: 10% !important;
    }

 
#padre{
  position: relative;
  background-color: transparent;
}

#uno {
  position: absolute;
  background-color: transparent;
  top: 30%;
  left: 50%;
  right: 0;
  margin: 0 auto;
  width: 5px;
}
 @media screen and (max-width: 980px){
    #contenedor{
        width: 90%;
    }
    #contenido{
        width: 60%;
    }
    #barra_lateral{
        width:30%;
    }
}
@media screen and (max-width: 480px){
    #encabezado{
        height: auto;
    }
    #contenido{
        width: auto;
    }
    #barra_lateral{
        display:none;
    }
}

@media screen and (min-width: 600px) {
     .hereIsMyClass {
          width: 30%;
          float: right;
     }
}

</style>

@if (session('mensaje'))
  <script>
    mensaje = {!! json_encode(session('mensaje'), JSON_HEX_TAG) !!};
    alertify.success(mensaje);
  </script> 
@endif 

<head><meta name='viewport' content='user-scalable=no' /></head>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

<script  src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script  src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script  src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
<script  src="https://cdn.datatables.net/plug-ins/1.13.1/api/sum().js"></script>

<br>

<br>

<script>

  $().ready(function(){
  $('#myTable').DataTable({
    'pageLength': 5,

   language:{ "sProcessing": "Procesando...",
        "sLengthMenu": "",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "",
        "sInfo": "",
        "sInfoEmpty": "",
        "sInfoFiltered": "",
        "sInfoPostFix": "",
        "sSearch": '<b>Buscar por nombre, apellidos o identidad</b>',
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
    }
    

  });



});




</script>
  

{{-- <div class="alert alert-success d-flex align-items-center" role="alert">
<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  {{session('mensaje')}}
</div> --}}


  <!-- Navbar content -->

{{-- Buscador--}} 
<h1 class="titulo" style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp; Listado de clientes</h1>  <br>

 

<div style="display: flex">  
<div style="width:100%" id="padre">


    <table class="table table-striped table-hover  border-dark bordeTabla" id="myTable" >

        <thead class="table-dark">
        <tr >
        <th  scope="col">#</th>
        <th  scope="col">Nombre</th> 
        <th  scope="col">Apellido</th>
        <th  scope="col">Número de identidad</th>
        <th  scope="col" style="text-align: center;">Detalles</th>
        <th  scope="col" style="text-align: center;">Editar</th>
        </tr>
        </thead>

     <tbody>   
        @forelse($clientes as $cl)
        <tr>
        <td scope="row">{{ $cl->id}}</td>
        <td>{{ $cl->Nombre }}</td>
        <td>{{ $cl->Apellido }}</td>
        <td>{{ $cl->Numero_identidad }}</td>

        {{-- Botones --}}
       <td style="text-align: center;"> <a  href="{{route('cliente.mostrar' , ['id' => $cl->id]) }}"><i class="bi bi-info-circle-fill"></i></a>  </td>
       <td style="text-align: center;"> <a  href="{{route('cliente.editar' , ['id' => $cl->id]) }}"> <i class="bi bi-pen-fill"></i></a>
        </td>
       </tr>
       @empty
       @endforelse
    </tbody>
    </table>
 
   
    </div>
      <div style="width: 15% " id="uno">
        <br>
        <a    class="btn btn-outline-dark" style="float:right" href="{{route('show.registroCliente')}}" >
        <i class="bi bi-plus-square-fill"></i>
      </a>
      </div>
      </div>


    

  <Script>
function busquedaJQsimple() {
  var filtro = $("#buscar").val().toUpperCase();

  $("#tabla tbody tr").each(function() {
    texto = $(this).children("td:eq(0)").text().toUpperCase();
    
    if (texto.indexOf(filtro) < 0) {
      $(this).hide();
    } else{
      $(this).show();
    }
    
  });
  
}
</Script>



@endsection
@include('common')