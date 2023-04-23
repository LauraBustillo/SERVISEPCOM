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



.btn-info{
    background-color: transparent;
    border: 1px solid #000000;
}

/*Los titulos */ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
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

/*Quitar Subrayado*/ 
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
        width: 80% !important;
     
    }

 
#padre{
  position: relative;
  background-color: transparent;
}

#uno {
  position: absolute;
  background-color: transparent;
  top: 21%;
  left: 65%;
  right: 0;
  margin: 0 auto;
  width: 5px;
}
.boton{
  width: 15% !important;
  display: inline-flex !important;
}

@media screen and (min-width: 1024px) { }
@media screen and (min-width: 321px) and (max-width: 768px) { }


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





/* fin de zona común a todas las resoluciones */
@media screen and (min-width:800px) {
	body {
		font-size:100%;
		/* ampliamos los textos si mide más de 800px */
	}
}

/* fin de la zona para más de 800px de ancho de pantalla */
@media screen and (min-width:1200px) {
	body {
		font-size:120%;
		/* ampliamos más aún los textos si mide más de 1200px */
	}
}

/* fin de la zona para más de 1200px de ancho de pantalla */
</style>

<head>
  	
<meta name="viewport" content="width=device-width, initial-scale=1.0"&amp;gt;>
</head>


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
        "sSearch": "Busqueda general",
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

@if (session('mensaje'))
  <script>
    mensaje = {!! json_encode(session('mensaje'), JSON_HEX_TAG) !!};
    alertify.success(mensaje);
  </script> 
@endif 

<h1 class="titulo" style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp; Listado de empleados</h1> 

<br> 
<div  id="uno">

          <a class="btn btn-outline-dark button" href="{{route('show.registroEmpleado')}}" >
          <i class="bi bi-plus-square-fill"></i></a>
     
</div>
<div style="display: flex">  
<div style="width:100%" id="padre">


        <table class="table table-striped table-hover  border-dark bordeTabla" id="myTable"  style="width:100%" >
            <thead  class="table-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Número de identidad</th>
            <th scope="col" style="text-align: center;">Detalles</th>
            <th scope="col" style="text-align: center;">Editar</th>  
            </tr>
            </thead>
 
        <tbody>   
            @forelse($empleados as $em)

            <tr>
            <td scope="row">{{ $em->id}}</td>
            <td>{{ $em->Nombres }}</td>
            <td>{{ $em->Apellidos }}</td>
            <td>{{ $em->Numero_identidad }}</td>
            
            {{-- Botones --}}
          <td  style="text-align: center;" ><a  href="{{route('empleado.mostrar' , ['id' => $em->id]) }}"><i class="bi bi-info-circle-fill"></i></a></td>

          

          <td  style="text-align: center;" ><a href="{{route('empleado.editar' , ['id' => $em->id]) }}"> <i class="bi bi-pen-fill"></i></a>  </td>
          </tr>
          @empty
          @endforelse
        </tbody>
        </table>
       
      </div> 
    
       
    </div>

@endsection
@include('common')