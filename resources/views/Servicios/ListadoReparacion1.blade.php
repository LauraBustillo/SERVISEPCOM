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
 width: 120% !important;
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


/*Cajas de texto*/
.form-control  {
        background-color: transparent;
        border: 1.3px solid #000000;
    }

    /*Las label*/
    .input-group-text  {
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

    /*Los botones*/
    .btn-outline-dark {
    background-color: transparent;
    border: 1.8px solid #000000;
    }
      /*Los titulos */
      .titulo1 {
      font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
      color:black;
      font-family: 'Open Sans';
      font-size: 40px;
      text-align: center;
    }

      /*Los titulos */
      .titulo2 {
      font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
      color:black;
      font-family: 'Open Sans';
      font-size: 30px;
      text-align: center;
    }

    /*Los titulos */
 .titulo {
   font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
   color: black;
   font-family: 'Open Sans';
   font-size: 20xp;
 }

    a { color: aliceblue;
    outline: none;
    text-decoration: none;
    color: #000000;
    }
    .a:hover{
        color: white;
    }

    .col1{
        width: 9%;
    }
    .col2{
        width: 91%;
    }
    .row{
        display: flex;
        width: 100%; 
    }
    .modal-body{
        background-color: rgb(142, 220, 243)!important;
    }

    .modal-header{
        background-color: rgb(184, 234, 249)!important;
    }

    .modal-content{
        background-color: rgb(184, 234, 249)!important;
    }

    .ancho{
        background-color: transparent;
        border: 1.8px solid #000000;
        width: 30%;
    }
    .anchoo{
        background-color: transparent;
        border: 1.8px solid #000000;
        width: 25.8%;
    }
    .box{
                display:flex;
            }

    .select, option{
        color:rgb(0, 0, 0);

    }
    .select{
        width: 20%;
        height: 15%;
        margin-left:0.3%;
        border: 1.8px solid #000000;
       border-radius: 0%;

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


 div.dataTables_wrapper div.dataTables_filter input {


width: 80% !important;
background-color: transparent;
border: 1.5px solid #000000;
float: left;

margin-bottom: 3%;
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
  top: 23%  !important;
  left: 62.5%;
  right: 0;
  margin: 0 auto;
  width: 5px; 
}
html, body {
    width: 100% !important;
}

/**/ 
  /*Las label*/ 
  .input-group-text  {
  background-color: #4c4d4e;;
  border: 1.3px solid #4c4d4e;;
  font-family: 'Open Sans';
  color: #FFFFFF;

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

      /*Los titulos  3 */ 
      .titulo3 {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color:#4c4d4e;
  font-family: 'Open Sans';
  font-size: 40px; }

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
.button-blue:active {
 box-shadow: 0 3px 0 #161616,
             0 4px 6px hsla(0, 0%, 0%, 0.7);
}

.boton1{
border: none;
}

.btn-outline-dark:hover{
   background-color: rgb(48, 48, 48);
   color: white;
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
 /*Los titulos */ 
 .titulo3 {
   font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
   color: black;
   font-family: 'Open Sans';
   font-size: 20xp;
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
          "sSearch": '<b>Buscar por nombre de cliente, categoría o estado</b>',
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
          var date = new Date( data[2] );

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
          format: 'YYYY-M-DD'
      });
      maxDate = new DateTime($('#max'), {
          format:  'YYYY-M-DD'


      });

      // DataTables initialisation

      var table = $('#myTable').DataTable();

      // Refilter the table
      $('#min, #max').on('change', function () {
          table.draw();


      });
  });


  </script>


  


  <h1 class="titulo3" style="text-align:center">Listado de reparación de equipos</h1>

 
  <div class="input-group "  style="display: flex" ><br>
  <div style="width: 20%" >
  <b><label for="" class="group-text">Fecha minima:</label></b>
  <input  class="form-control" id="min" name="min" value=""> 
  </div> &nbsp;&nbsp;
  
  <div style="width: 20%">
    <b><label for="" class="group-text">Fecha  máxima:</label></b>
    <input   class="form-control" id="max" name="max" value="" > 
  </div> &nbsp;&nbsp;

  <div style="width: 8"><br>
  <a href="{{ route('reparacion.index') }}" class="btn btn-outline-dark" ><i class="bi bi-trash3-fill"></i></a>
    
  </div>&nbsp;&nbsp;

<div style="width: 49%"><br>
      <a class="btn btn-outline-dark" style="float:right" href="{{ route('RegistroReparacion')}}">
      <i class="bi bi-plus-square-fill"></i></a>
</div>

</div>
<div >  
<br> 

<div>
    <table class="table table-striped table-hover  border-dark bordeTabla display" id="myTable">
        <thead class="table-dark">
        <tr>
        {{-- <th scope="col">#</th> --}}
        <th scope="col">Nombre del cliente</th>
        <th scope="col">Categoría</th>
        <th scope="col">Fecha de ingreso</th>
        <th scope="col">Estado</th>
        <th scope="col">Factura</th>
        <th scope="col"  style="text-align: center;">Detalles</th>
        <th scope="col"  style="text-align: center;">Editar</th>
        <th scope="col"  style="text-align: center;">Facturar</th>
        
        </tr>
        </thead>
  
     <tbody>

      @forEach($reparaciones as $r)
        <tr>
          <td>{{$r->Nombre}} {{$r->Apellido}}</td>
          <td>{{$r->categoria}} </td>
          <td>{{$r->fecha_ingreso}} </td>
          <td>{{$r->estado}} </td>
          <td>{{$r->numero_factura != null && $r->numero_factura != '' ? $r->numero_factura  : "no facturado"}} </td>

          <td  style="text-align: center;" >
            <a class="btn-detalles" href="{{route('repacionones.ver' , ['id' => $r->id]) }}"> <i class="bi bi-info-circle-fill"></i></a> &nbsp;&nbsp;
          </td >
          <td  style="text-align: center;" >
          

            <a class="btn-detalles" href="{{route('reparacion.mostrar' , ['id' => $r->id]) }}">  <i class="bi bi-pen-fill"></i> </a>

          </td>
          <td  style="text-align: center;">
            




            <a  style="color: #000000;text-decoration:none" class="btn-detalles" {{strlen($r->numero_factura) != 19 ? "" : "hidden"}} onclick="openmodalfacturar({{$r}})">  <i class="bi bi-clipboard-check-fill"> Facturar </i> </a>&nbsp;&nbsp;
            <a  style="color: #000000;text-decoration:none" href="{{ route('pdf.reparacion', ['id'=>$r->id]) }}" class="btn-detalles" {{strlen($r->numero_factura) == 19 ? "" : "hidden"}}>  <i class="bi bi-printer-fill"></i> </a>
          </td>
         
        </tr>
      @endforeach

    </tbody>
    </table>
  </div>
  {{-- MODAL DE FACTURACION --}}
    <div class="modal fade" id="modalafacturarReparacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="titulo1">
                        Facturar Reparación
                    </h3>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guardarFacturaReparacion.update') }}" method="POST" id="formulario_factura">
                        @csrf
                        <input id="id_r" name="id_r" hidden value="">

                        <div style="display: flex">
                            <div style="width: 100%">
                      
                                <span class="input-group-text" style="width: 100%"  id="inputGroup-sizing-sm">Número factura</span>

                                <input readonly id="numero_facturaR" type="text" name="numero_facturaR" class="form-control" placeholder="Número factura" value="{{ $num_factura }}">
                            </div>
                            &nbsp;&nbsp;
                            <div style="width: 100%">
                               
                                <span class="input-group-text" style="width: 100%"  id="inputGroup-sizing-sm">Fecha facturación</span>

                                <input id="fecha_facturacionR" type="date" readonly name="fecha_facturacionR" class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Fecha facturacion">
                            </div>
                        </div>
                        <br>

                        <div style="display: flex">
                            <div style="width: 100%">
                                
                                <span class="input-group-text" style="width: 100%"  id="inputGroup-sizing-sm">Precio reparación</span>

                                <input maxlength="4" id="precio_reparacion" type="text" name="precio_reparacion" class="form-control" placeholder="Precio reparación">
                            </div>
                            &nbsp;&nbsp;
                            <div style="width: 100%">
                              
                                <span class="input-group-text" style="width: 100%"  id="inputGroup-sizing-sm">Descripción</span>

                                <textarea id="descripcion_reparacion" type="text" name="descripcion_reparacion" class="form-control" placeholder="Descripción" rows="1"></textarea>
                            </div>
                        </div>

                    </form>

                    <div class="modal-footer" style="text-align: center">
                        <button type="button"  class="button button-blue " onclick="cerrarmodalfacturar()"><i class="bi bi-x-circle"> Cerrar</i></button>
                        <button type="button"  class="button button-blue " onclick="guardarfacturar()"><i class="bi bi-folder-fill"> Guardar</i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>

<script>

  var myModalFacturar = new bootstrap.Modal(document.getElementById('modalafacturarReparacion'));
  function openmodalfacturar(mante){
    myModalFacturar.show();
    document.getElementById('id_r').value = mante.id ;
    document.getElementById('precio_reparacion').value = mante.precio ;
    document.getElementById('descripcion_reparacion').value = mante.descripcion ;
  }

  function cerrarmodalfacturar(){
    myModalFacturar.hide();
  }

  function guardarfacturar(){


    var formul = document.getElementById("formulario_factura");

      var id_r = document.getElementById('id_r').value;
      var numero_facturaR = document.getElementById('numero_facturaR').value;
      var fecha_facturacionR = document.getElementById('fecha_facturacionR').value;
      var precio_reparacion = document.getElementById('precio_reparacion').value;
      var descripcion_reparacion = document.getElementById('descripcion_reparacion').value;

      // faltan validaciones


        //validaciones

    var numeros = /([0-9])/;
    //Numero de factura
    if (document.getElementById("numero_facturaR").value == '') {
      alertify.error("El número de factura es requerido");
      return;

    }else if(numero_facturaR.length > 19){
                alertify.error('El número de factura el máximo es de 19 caracteres')
                return;
         }else if(numero_facturaR.length < 19){
                alertify.error('El número de factura el mínimo es de 19 caracteres')
                return;
              }
                else if (!numeros.test(numero_facturaR)) {
                alertify.error("El número de factura, solo debe tener números ");
                return;

            }

    //Fecha facturacion
    if (document.getElementById("fecha_facturacionR").value == '') {
      alertify.error("La fecha de facturación es requerida");
      return;
    }

    //Precio de reparacion
    if (document.getElementById("precio_reparacion").value == '') {
      alertify.error("El precio del reparación es requerido");
      return;

    }else if(precio_reparacion.length < 2){
                alertify.error('El precio, mínimo debe tener 2 caracteres');
                return;
                }
                else if (!numeros.test(precio_reparacion)) {
                alertify.error("El precio solo debe tener números ");
                return;

            }
      if (document.getElementById("precio_reparacion").value == 0) {
      alertify.error("El precio del reparación no debe ser cero");
      return;
           }

 // Descripcion
    if (document.getElementById("descripcion_reparacion").value == '') {
      alertify.error("La descripción es requerida");
      return;
    }


    formul.submit();



  }

</script>





@endsection
@include('common')