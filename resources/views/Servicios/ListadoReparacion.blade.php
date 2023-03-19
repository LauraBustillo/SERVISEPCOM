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
     language:{ "sProcessing": "Procesando...",
          "sLengthMenu": "",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "",
          "sInfo": "",
          "sInfoEmpty": "",
          "sInfoFiltered": "",
          "sInfoPostFix": "",
          "sSearch": "Buscar por nombre de cliente, categoría o estado",
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




{{-- Buscador--}}

{{--<nav class="navbar navbar-nav bg-nav" >
  <div class="container-fluid" >
    <form class="d-flex" id="ablescroll" method="POST" action="Mantenimiento">
    @csrf
      <input type="text" style="width: 500px;"  class="form-control me-2" name="buscar" value="" placeholder="Buscar por nombre del cliente, categoría y estado" aria-label="Sizing example input">
      <button  type="submit" class="btn btn-outline-dark me-2" id="buscar" name="buscador" value=" "><i class="bi bi-search"> </i></button>
      <a href="{{ route('mantenimiento.index') }}" class="btn btn-outline-dark" ><i class="bi bi-x-square"></i></a>
    </form>

  </div>
  </nav>--}}
  <h1 class="titulo" style="text-align:center">Listado de reparación de equipos</h1>
<br>
<div class="input-group " style="float:right" style="width: 100%" >
 <div >
    <label for="" class="group-text">Fecha mínima:</label>
    <input  class="form-control" id="min" name="min">
    </div>&nbsp; &nbsp;&nbsp;

    <div >
      <label for="" class="group-text">Fecha  máxima:</label>
      <input   class="form-control" id="max" name="max" >
      </div>
      <div><br>&nbsp; &nbsp;
      <a href="{{ route('mantenimiento.index') }}" class="btn btn-outline-dark" ><i class="bi bi-x-square"></i></a>




  </div>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a class="btn btn-outline-dark" style="float:right" href="{{ route('RegistroReparacion')}}">
    <i class="bi bi-person-plus-fill"> Nueva reparación </i></a>

  </div>
  <br>
<div>

<div>
    <table class="table table-hover" id="myTable">
        <thead>
        <tr>
        {{-- <th scope="col">#</th> --}}
        <th scope="col">Nombre del cliente</th>
        <th scope="col">Categoría</th>
        <th scope="col">Fecha de ingreso</th>
        <th scope="col">Estado</th>
        <th scope="col">Factura</th>
        <th scope="col">Detalles</th>
        <th scope="col">Editar</th>
        <th scope="col">Facturar</th>
        
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

          <td>
            <a class="btn-detalles" href="{{route('repacionones.ver' , ['id' => $r->id]) }}"> <i class="bi bi-file-text-fill"> Detalles</i> </a> &nbsp;&nbsp;
          </td>
          <td>
            <a class="btn-detalles" href="{{route('reparacion.mostrar' , ['id' => $r->id]) }}">  <i class="bi bi-pen-fill"> Editar </i> </a>
          </td>
          <td>
            <a  style="color: #000000;text-decoration:none" class="btn-detalles" {{strlen($r->numero_factura) != 19 ? "" : "hidden"}} onclick="openmodalfacturar({{$r}})">  <i class="bi bi-clipboard-check-fill"> Facturar </i> </a>&nbsp;&nbsp;
            <a  style="color: #000000;text-decoration:none" href="{{ route('pdf.reparacion', ['id'=>$r->id]) }}" class="btn-detalles" {{strlen($r->numero_factura) == 19 ? "" : "hidden"}}>  <i class="bi bi-clipboard-check-fill"> Imprimir </i> </a>

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
                                <label id="inputGroup-sizing-sm">Número factura</label>
                                <input readonly id="numero_facturaR" type="text" name="numero_facturaR" class="form-control" placeholder="Número factura" value="{{ $num_factura }}">
                            </div>
                            &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label id="inputGroup-sizing-sm">Fecha facturación</label>
                                <input id="fecha_facturacionR" type="date" readonly name="fecha_facturacionR" class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Fecha facturacion">
                            </div>
                        </div>

                        <div style="display: flex">
                            <div style="width: 100%">
                                <label id="inputGroup-sizing-sm">Precio reparación</label>
                                <input maxlength="4" id="precio_reparacion" type="text" name="precio_reparacion" class="form-control" placeholder="Precio reparación">
                            </div>
                            &nbsp;&nbsp;
                            <div style="width: 100%">
                                <label id="inputGroup-sizing-sm">Descripción</label>
                                <textarea id="descripcion_reparacion" type="text" name="descripcion_reparacion" class="form-control" placeholder="Descripción" rows="2"></textarea>
                            </div>
                        </div>

                    </form>

                    <div class="modal-footer" style="text-align: center">
                        <button type="button" class="btn btn-outline-dark" onclick="cerrarmodalfacturar()"><i class="bi bi-x-circle"> Cerrar</i></button>
                        <button type="button" class="btn btn-outline-dark" onclick="guardarfacturar()"><i class="bi bi-folder-fill"> Guardar</i></button>
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
