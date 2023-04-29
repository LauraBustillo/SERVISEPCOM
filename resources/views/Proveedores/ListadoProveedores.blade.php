@extends('main')
@section('extra-content')
<style>
   .input-group-text  {
  background-color: #B8D7F9;
  border: 1.5px solid #000000;
}

.form-control  {
    background-color: transparent;
    border: 1.5px solid #000000;
}

.table-1{
    width: 100%;
    color: rgb(3, 10, 1);
  
    border: 1px solid #000000;

}

.table-1 th{
    background-color: #0319C4;
    color:white;
    padding: .2rem;
    text-align: start;
}

.btn-info{
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
  left: 50.5%;
  right: 0;
  margin: 0 auto;
  width: 5px;
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


{{-- Buscador--}}
<h1 class="titulo" style="text-align:center">Listado de proveedores</h1> 
<br>

<div style="display: flex">  
<div style="width:100%" id="padre">

   
  
    <table class="table table-striped table-hover  border-dark bordeTabla" id="myTable" >

        <thead  class="table-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre de la empresa</th>
        <th scope="col">Teléfono de la empresa </th>
        <th scope="col">Nombre del encargado</th>
        <th scope="col"  style="text-align: center;" >Detalles </th>
        <th scope="col"  style="text-align: center;" >Editar</th>  
        </tr>
        </thead>

     <tbody>   
        @forelse($proveedores as $pro)

        <tr>
        <td scope="row">{{ $pro->id}}</td>
        <td>{{ $pro->Nombre_empresa }}</td>
        <td>{{ $pro->Telefono_empresa }}</td>
        <td>{{ $pro->Nombre_encargado }}</td>
        
        {{-- Botones --}}
       <td  style="text-align: center;"><a  href="{{route('proveedor.mostrar' , ['id' => $pro->id]) }}"><i class="bi bi-info-circle-fill"></i></a></td>
       <td  style="text-align: center;"><a  href="{{route('proveedor.editar' , ['id' => $pro->id]) }}"> <i class="bi bi-pen-fill"></i></a></td>
       </tr>
       @empty
       @endforelse
      
    </tbody>
    </table>

    </div>
      <div style="width: 15% " id="uno">
      <br>
   
         <a    class="btn btn-outline-dark" style="float:right" href="{{route('show.registroProveedor')}}" >
         <i class="bi bi-plus-square-fill"></i></a>
         </div>
      </div>

  



@endsection
@include('common')