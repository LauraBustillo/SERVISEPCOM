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
 
 /*Quitar Subrayado*/ 
  a:link, a:visited, a:active, a:focus{
     text-decoration:none;
     Color: black; 
    
   }

  div.dataTables_wrapper div.dataTables_filter input {

  display: inline-block;
  width: 80% !important;
  background-color: transparent;
     border: 1.5px solid #000000;
     float: left;
}
.dataTables_wrapper .dataTables_filter {
    float: left !important ;
    text-align: left !important;
  width: 100% !important;

}


 </style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

<script  src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script  src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script  src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
<script  src="https://cdn.datatables.net/plug-ins/1.13.1/api/sum().js"></script>
<br>

<script>

  $().ready(function(){
  $('#example').DataTable({
   language:{ "sProcessing": "Procesando...",
        "sLengthMenu": "",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "",
        "sInfo": "",
        "sInfoEmpty": "",
        "sInfoFiltered": "",
        "sInfoPostFix": "",
        "sSearch": "Buscar por número de factura, proveedor y total de factura",
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

var minDate, maxDate;

// Custom filtering function which will search data in column four between two values


$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {


       var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[1] );
 
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: ' DD - M - YYYY '
    });
    maxDate = new DateTime($('#max'), {
        format:  'YYYY - M - DD'

       
    });
 
    // DataTables initialisation

    var table = $('#example').DataTable();
 
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });
});





</script>


  <h1 class="titulo" style="text-align:center">Listado de facturas de compras</h1> 
 
{{-- Buscador
  <nav class="navbar navbar-nav bg-nav" >
    <div class="container-fluid" >
      <form class="d-flex" id="ablescroll" method="POST" action="Compra">

      @csrf
        <input type="text" style="width: 500px;"  class="form-control me-2" name="buscar" value="{{$buscar}}"
         placeholder="Buscar por número de factura, fecha de facuración y proveedor" aria-label="Sizing example input">
        <button  type="submit" class="btn btn-outline-dark me-2" id="buscar" name="buscador" value=" "><i class="bi bi-search"> </i></button>
        <a href="{{ route('compra.index') }}" class="btn btn-outline-dark" ><i class="bi bi-x-square"></i></a> 
      </form>  </div> 
    </nav> --}}

      
    
  
  <nav class="navbar navbar-nav bg-nav" >
    <div class="container-fluid" >
      <form style="display:flex" id="ablescroll" method="POST" action="Compra">
      @csrf
     
      <br>
  
       
      </form>
    </div>
    </nav>


    <div class="input-group " style="padding-right:4%"  style="width: 100%" ><br>
      <div >
      <label for="" class="group-text">Fecha minima:</label>
      <input  class="form-control" id="min" name="min"> 
      </div>&nbsp; &nbsp;&nbsp;
      
      <div >
        <label for="" class="group-text">Fecha  máxima:</label>
        <input   class="form-control" id="max" name="max" > 
        </div>
        <div><br>&nbsp; &nbsp;
        <a href="{{ route('compra.index') }}" class="btn btn-outline-dark" ><i class="bi bi-x-square"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
        <a class="btn btn-outline-dark" style="float:right" href="{{route('show.registroCompras')}}" >
          <i class="bi bi-cart-plus"> Nueva compra  </i></a>
      </div>
  
      </div>  
 
      
    <table id='example' class="table table-hover tablacompras"> <br>  
        <thead>
        <tr>
        
        <th scope="col">Número de factura</th>
        <th scope="col">Fecha de facturación</th>
        <th scope="col">Proveedor </th>
        <th scope="col">Total de la factura </th>
        <th scope="col"> Detalles</th>
        </tr>
        </thead>

     <tbody>   
        @forelse($compras as $de)

        <tr>
       <td scope="row">{{ $de->Numero_factura}}</td>
        <td>{{ $de->Fecha_facturacion }}</td>
        <td>{{ $de->Nombre_empresa}}</td>
       <td name="valores">Lps. {{ $de->Total_factura }}</td>
        
        {{-- Botones --}}
      <td><a class="btn-detalles" href="{{route('compra.mostrar' , ['id' => $de->compras]) }}"> <i class="bi bi-file-text-fill"> Detalles </i> </a></td>
       </tr>
       @empty
       @endforelse
    </tbody>
    </table>
  </div>
<br>
<div style="float:right">
  <label for="" style="font-size: 120%">Total de facturas</label>&nbsp;
  <input disabled type="text" value="" id="total_facturas"  name="calculo" > 
  
</div>
  

  
 <script>

let compras = {!! json_encode($compras, JSON_HEX_TAG) !!}; 
console.log(compras);
total = 0;
compras.forEach(element => {
  total += element.Total_factura
});
document.getElementById("total_facturas").value = total.toFixed(2);


    // function busquedaJQsimple() {
    //   var filtro = $("#buscar").val().toUpperCase();
    
    //   $("#tabla tbody tr").each(function() {
    //     texto = $(this).children("td:eq(0)").text().toUpperCase();
        
    //     if (texto.indexOf(filtro) < 0) {
    //       $(this).hide();
    //     } else{
    //       $(this).show();
    //     }
        
    //   });
      
    // }
    </script>


  
{{-- {{ $compras->links() }} --}}

@endsection
@include('common')