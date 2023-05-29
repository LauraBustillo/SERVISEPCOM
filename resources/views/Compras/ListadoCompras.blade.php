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

    /*Quitar Subrayado*/
    a:link,
    a:visited,
    a:active,
    a:focus {
        text-decoration: none;
        Color: black;

    }

 div.dataTables_wrapper div.dataTables_filter input {


width: 70% !important;
background-color: transparent;
border: 1.5px solid #000000;
float: left;

margin-bottom: 3% !important;
}



.dataTables_wrapper .dataTables_filter {
float: left !important ;
text-align: left !important;
width: 100% !important;

}

    .dt-buttons {
        padding-left: 85% !important;
    }

    .dt-button {
        padding: 0 !important;
        border: none !important;
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



 
#padre{
  position: relative;
  background-color: transparent;
}

#uno {
  position: absolute;
  background-color: transparent;
  top: 21%;
  left: 64.5%;
  right: 0;
  margin: 0 auto;
  width: 5px; 
}
 
div.container {
        width: 100% !important;
        height: 100% !important;
        padding-left: 10% !important;
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
 

    // variable para hacer el string de fechas de los reportes
    var fechasExportReporte = '';
    var fechasExportReportep = '';
   var tablecompras  = $('#tablecompras').DataTable({
    dom: 'lfrBtip',
   
    'pageLength': 5,
   language:{ "sProcessing": "Procesando...",
        "sLengthMenu": "",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "",
        "sInfo": "",
        "sInfoEmpty": "",
        "sInfoFiltered": "",
        "sInfoPostFix": "",
        "sSearch": '<b>Buscar por número de factura, proveedor y total de factura</b>',
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
        extend: 'print',
        footer: true,
        text:  '<button class ="btn btn-secondary" > <i class="fa fa-print" ></i></button>',
        titleAttr: 'Imprimir',
        title:'Reporte de listado factura de compras ',
        messageTop:'', 
        messageTop: function () {
    return fechasExportReporte; // where `myVariable` is accessible in this scope and set somewhere else
  },
        exportOptions: { columns: [0, 1, 2, 3] },

        customize: function ( win ) {
                        $(win.document.body).find('h1').css('text-align', 'center');
                        $(win.document.body).css( 'font-size', '15px' ) .css( 'font-weight', 'bolder' ) .css('color',  '2f3287');
                        $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
},
      },
           
  

      {
   extend: 'pdfHtml5',
   footer: true,
  messageTop: function () {
    return fechasExportReportep; // where `myVariable` is accessible in this scope and set somewhere else
  },
   text:  '<button class ="btn btn-danger" > <i class="fa fa-file-pdf-o"></i></button>',
   titleAttr: 'Archivo PDF',
   orientation: 'portrait',
   pageSize: 'A4',
   title: 'Reporte de listado factura de compras',

  //  var suma = tablecompras.column(3,).data().sum();  
   exportOptions: { columns: [0, 1, 2, 3,] ,
    // {search: 'applied'} 
  },

customize: function(doc) {
  doc.content[1].margin =[0, 5, 7, 5] ,
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
      
    ]

  } 
  
  );

  


  var minDate, maxDate;

    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'DD - M - YYYY' 
    });
    maxDate = new DateTime($('#max'), {
        format:  'DD - M - YYYY'       
    });
 
    // Refilter the table
    $('#min, #max').on('change', function () {


      //Funcion para mostrar el rango de recha desde hasta
      var fechamin =  document.getElementById("min").value;
      var fechamax =  document.getElementById("max").value;
      if( fechamin != "" && fechamax == "" ){
        fechasExportReporte = " Mostrando información desde:  "  + "<b> " + fechamin + "</b> " + "&nbsp;" +" en delante";
      }else if(fechamin != "" && fechamax != ""){
        fechasExportReporte = " Mostrando información desde:   " + "<b> " + fechamin + "</b> " + "&nbsp;" + " hasta " + "&nbsp;" + "<b> " + fechamax  + "</b> ";
      }

      var fechamin =  document.getElementById("min").value;
      var fechamax =  document.getElementById("max").value;
      if( fechamin != "" && fechamax == "" ){
        fechasExportReportep = " Mostrando información desde:  "   + fechamin +" en delante";
      }else if(fechamin != "" && fechamax != ""){
        fechasExportReportep = " Mostrando información desde: " + fechamin  + " hasta " +  fechamax ;
      }
      
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
      tablecompras.draw();
    });

      //obtenemos los valores a sumar de la columna que queremos(3), y le pasaamos que con el searh aplicado

      var suma = tablecompras.column(3, {
            search: 'applied'
        }).data().sum();
        document.getElementById("total_facturas").innerHTML = "Lps. " + suma.toFixed(2);
    
    setTimeout(() => {
      
      //detectando el cambio del input del search, para volver a actualizar la suma
      $('input[aria-controls=tablecompras]').on('input', function() {
                var suma = tablecompras.column(3, {
                    search: 'applied'
                }).data().sum();
                document.getElementById("total_facturas").innerHTML = "Lps. " + suma.toFixed();
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



</script>


  <h3 class="titulo" style="text-align:center">Listado de facturas de compras</h3> 

    
      @csrf

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
  <a href="{{ route('compra.index') }}" class="btn btn-outline-dark" ><i class="bi bi-trash3-fill"></i></a>    
  </div>&nbsp;&nbsp;

  <div style="width: 49%"><br>
  <a class="btn btn-outline-dark" style="float:right" href="{{route('show.registroCompras')}}" >
  <i class="bi bi-plus-square-fill"></i></a>
  </div>

</div>
<div > 
</div>  
 <br>

    <table class="table table-striped table-hover  border-dark bordeTabla display" id="tablecompras" style="width:100%">

        <thead class="table-dark">
        <tr>
        
        <th scope="col" style="text-align: center;">Número de factura</th>
        <th scope="col" style="text-align: center;">Fecha de facturación</th>
        <th scope="col" style="text-align: center;">Proveedor </th>
        <th scope="col" style="text-align: center;">Total  </th>
        <th scope="col"  style="text-align: center;"> Detalles</th>
        </tr>
        </thead>

     <tbody>   
      @php
            $total1 = 0;
        @endphp
        @forelse($compras as $de)

        <tr>
       <td scope="row">{{ $de->Numero_factura}}</td>
        <td>{{ $de->Fecha_facturacion }}</td>
        <td>{{ $de->Nombre_empresa}}</td>
       <td name="valores" style="text-align: right">{{ $de->Total_factura }}</td>
        
        {{-- Botones --}}
      <td style="text-align: center;"><a href="{{route('compra.mostrar' , ['id'=>$de->compras]) }}">
        <i class="bi bi-info-circle-fill"></i></a></td>
       </tr>
       @php
       $total1 += $de->Total_factura;
   @endphp
       @empty
       @endforelse
    </tbody>
    <tfoot>
      <tr>
          <td></td>
          <td></td>
          <td><b>Total</b></td>
           <td  id="total_facturas" style="text-align: right"> {{ number_format($total1,2) }}</td></b>
          <td></td>
      </tr>
  </tfoot>
    </table>
  </div>
<br>

</div>  

@endsection
@include('common')