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

.dt-buttons{
  padding-left: 85% !important;
}
.dt-button{
  padding: 0 !important;
  border: none !important;  
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

  var tablecompras  = $('#tablecompras').DataTable({
    dom:  '<"wrapper"fBlitp>',
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
    },

    buttons: [
      {
      extend:    'print',
      text:  '<button class ="btn btn-secondary" > <i class="fa fa-print" ></i></button>',
      titleAttr: 'Imprimir',
      exportOptions: { columns: [0, 1, 2, 3] } 
      },
      {
   extend: 'pdfHtml5',
   text:  '<button class ="btn btn-danger" > <i class="fa fa-file-pdf-o"></i></button>',
   titleAttr: 'Archivo PDF',
   orientation: 'portrait',
   pageSize: 'A4',
   title: 'Reporte de compras',
   exportOptions: { columns: [0, 1, 2, 3,4] ,
    
},

customize: function(doc) {
  doc.content[1].margin =[100, 0, 100, 0] ,
  doc.content.splice(1, 0, {
      columns: [{
      }
     ],
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
      exportOptions: { columns: [0, 1, 2, 3] } 
      }
    ]

  });


    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: ' DD - M - YYYY '
    });
    maxDate = new DateTime($('#max'), {
        format:  'YYYY - M - DD'       
    });
 
    // Refilter the table
    $('#min, #max').on('change', function () {
      tablecompras.draw();
    });

      //obtenemos los valores a sumar de la columna que queremos(3), y le pasaamos que con el searh aplicado
      var suma = tablecompras.column(3,{search: 'applied'}).data().sum();      
      document.getElementById("total_facturas").innerHTML = "Lps. "+suma.toFixed(2);
    
    setTimeout(() => {
      //detectando el cambio del input del search, para volver a actualizar la suma
      $('input[aria-controls=tablecompras]').on('input', function() {
        var suma = tablecompras.column(3,{search: 'applied'}).data().sum();      
        document.getElementById("total_facturas").innerHTML = "Lps. "+suma.toFixed(2);
      });     

      //detectando el cambio del input del max fecha, para volver a actualizar la suma
      $("#max").change(function(){
        var suma = tablecompras.column(3,{search: 'applied'}).data().sum();      
        document.getElementById("total_facturas").innerHTML = "Lps. "+suma.toFixed(2);
    	});

      //detectando el cambio del input del min fecha, para volver a actualizar la suma
      $("#min").change(function(){
        var suma = tablecompras.column(3,{search: 'applied'}).data().sum();      
        document.getElementById("total_facturas").innerHTML = "Lps. "+suma.toFixed(2);
      });

    }, 2000);

  });

  var minDate, maxDate;

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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a class="btn btn-outline-dark" style="float:right" href="{{route('show.registroCompras')}}" >
          <i class="bi bi-cart-plus"> Nueva compra  </i></a>
      </div>
  
      </div>  
 
      
    <table id='tablecompras' class="table table-hover tablacompras"> <br>  
        <thead>
        <tr>
        
        <th scope="col">Número de factura</th>
        <th scope="col">Fecha de facturación</th>
        <th scope="col">Proveedor </th>
        <th scope="col">Total  </th>
        <th scope="col"> Detalles</th>
        </tr>
        </thead>

     <tbody>   
        @forelse($compras as $de)

        <tr>
       <td scope="row">{{ $de->Numero_factura}}</td>
        <td>{{ $de->Fecha_facturacion }}</td>
        <td>{{ $de->Nombre_empresa}}</td>
       <td name="valores">{{ $de->Total_factura }}</td>
        
        {{-- Botones --}}
      <td><a class="btn-detalles" href="{{route('compra.mostrar' , ['id' => $de->compras]) }}"> <i class="bi bi-file-text-fill"> Detalles </i> </a></td>
       </tr>
       @empty
       @endforelse
    </tbody>
    </table>
  </div>
<br>
<div style="padding-left: 78%">
  <b><label for="" style="font-size: 100%">Total facturas</label></b>&nbsp;
  <b><label id="total_facturas" ></label></b>
  
</div>
  

@endsection
@include('common')