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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

{{-- <script  src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}

<script  src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script  src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
<script  src="https://cdn.datatables.net/plug-ins/1.13.1/api/sum().js"></script>

<script>
var table2 = '';
  $().ready(function(){
   table2 =  $('#myTable2').DataTable({
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

  var minDate, maxDate;
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'YYYY-M-DD'
    });
    maxDate = new DateTime($('#max'), {
        format:  'YYYY-M-DD'       
    });


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


    // Refilter the table
    $('#min, #max').on('change', function () {
        table2.draw();
    });



          
          // $('#myTable2').on('click', 'tbody > tr > td', function () {
            
          //     var cellIndex = '';
          //     cellIndex = table2.cell(this).index();
          //     var rowData = '';
          //     rowData = table2.row(this).data();
        
          //   $('body').on('click', '#switchda', function(){
          //     newData = [ "1", "1", "1", "1", "1", "1", "1", "1" ] //Array, data here must match structure of table data
          //     table2.row(cellIndex.row).data( newData ).draw();
          //     console.log(cellIndex.row);
          //     console.log(rowData[7]);
          //   })
          // }); 

           
            
          

  
});

</script>


@if (session('mensaje'))
  <script>
    mensaje = {!! json_encode(session('mensaje'), JSON_HEX_TAG) !!};
    alertify.success(mensaje);
  </script> 
@endif 




{{-- Buscador--}}
<h1 class="titulo" style="text-align:center">Listado de mantenimiento de equipos</h1> 
<br>
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
      <a class="btn btn-outline-dark" style="float:right" href="{{ route('RegistroMantenimiento')}}">
    <i class="bi bi-person-plus-fill"> Nuevo Mantenimiento </i></a>

  </div>   
  <br>
<div> 

<div>    
    <table class="table table-hover" id="myTable2">
        <thead>
        <tr>
        {{-- <th scope="col">#</th> --}}
        <th scope="col">Nombre del cliente</th>
        <th scope="col">Categoría</th>
        <th scope="col">Fecha de ingreso</th>
        <th scope="col">Estado</th>
        <th scope="col">Factura #</th>  
        <th scope="col">Total Factura (Lps)</th> 
        <th scope="col">Detalle</th>
        <th scope="col">Editar</th>
        <th scope="col">Facturar</th> 
        </tr>
        </thead>

     <tbody>   
       
      @forEach($mantenimientos as $m)
        <tr>
          <td>{{$m->Nombre}} {{$m->Apellido}}</td>
          <td>{{$m->categoria}} </td>
          <td>{{$m->fecha_ingreso}} </td>
          <td>{{$m->estado}} </td>
          <td>{{$m->numero_factura != null && $m->numero_factura != '' ? $m->numero_factura  : "no facturado"}} </td>
          <td>{{$m->precio}} </td>
          
          <td>
            <a class="btn-detalles mr-2" href="{{route('mantenimientos.ver' , ['id' => $m->id]) }}"> <i class="bi bi-file-text-fill"> Detalles</i> </a>    &nbsp;&nbsp;     
          </td>  
          <td>
            <a class="btn-detalles mr-2" href="{{route('mantenimiento.mostrar' , ['id' => $m->id]) }}"> <i class="bi bi-pen-fill"> Editar </i> </a> &nbsp;&nbsp;
          </td>
          <td>
            <a style="color: #000000;text-decoration:none" class="quitar btn-detalles text-black" {{$m->estado == 'Finalizado' ? "" : "hidden"}} onclick="openmodalfacturar({{$m}})"><i class="bi bi-clipboard-check-fill"> Facturar </i> </a> 
          </td>

        </tr>
      @endforeach
      
    </tbody>
    </table>
  </div>

  


  <div class="modal fade"  id="modalafacturarMantenimiento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl" >
    <div class="modal-content">
        <div class="modal-header"><h3 class="titulo1">
          Facturar mantenimiento
        </h3></div>
        <div class="modal-body" > 
      
          <input  id="id_m" hidden value="">

          <div style="display: flex">
            <div style="width: 100%">
              <label  id="inputGroup-sizing-sm">Número factura</label> 
              <input value="{{old('numero_facturaM')}}" id="numero_facturaM" type="text" maxlength="11" name="numero_facturaM" class="form-control" 
              placeholder="Número factura">
            </div>
            &nbsp;&nbsp;     
            <div style="width: 100%">
              <label  id="inputGroup-sizing-sm">Fecha facturación</label> 
              <input value="{{old('fecha_facturacionM')}}"  id="fecha_facturacionM" type="date"  name="fecha_facturacionM" class="form-control" 
              placeholder="Fecha facturación" >
            </div>        
          </div>
      
          <div style="display: flex">
            <div style="width: 100%">
              <label  id="inputGroup-sizing-sm">Precio mantenimiento</label> 
              <input  value="{{old('precio_mantenimientoM')}}"  id="precio_mantenimientoM" type="text" name="precio_mantenimientoM" class="form-control" maxlength="4"
              placeholder="Precio mantenimiento">
            </div>
            &nbsp;&nbsp;   
            <div style="width: 100%">
              <label  id="inputGroup-sizing-sm">Descripción</label> 
              <textarea  id="descripcion_mantenimiento" type="text" name="descripcion_mantenimiento" class="form-control" 
              placeholder="Descripción de lo que se realizó en el mantenimiento"  rows="2" >{{old('descripcion_mantenimiento')}}</textarea>
            </div>        
          </div>

            <div class="modal-footer" style="text-align: center">
              <button  type="button" class="btn btn-outline-dark" onclick="cerrarmodalfacturar()"><i class="bi bi-x-circle"> Cerrar</i></button>
              <button  type="button" class="btn btn-outline-dark" onclick="guardarfacturar()"><i class="bi bi-folder-fill"> Guardar</i></button>
            </div>
        </div>
  
    </div>
    </div>
  </div>



<script>

var myModalFacturar = new bootstrap.Modal(document.getElementById('modalafacturarMantenimiento'));
  function openmodalfacturar(mante){
    myModalFacturar.show();
    document.getElementById('id_m').value = mante.id ;
    document.getElementById('numero_facturaM').value = mante.numero_factura ;
    document.getElementById('fecha_facturacionM').value = mante.fecha_facturacion ;
    document.getElementById('precio_mantenimientoM').value = mante.precio;
    document.getElementById('descripcion_mantenimiento').value = mante.descripcion ;
  }

  function cerrarmodalfacturar(){
    myModalFacturar.hide();
  }

  function guardarfacturar(){

      var id_m = document.getElementById('id_m').value;
      var numero_facturaM = document.getElementById('numero_facturaM').value;
      var fecha_facturacionM = document.getElementById('fecha_facturacionM').value;
      var precio_mantenimientoM = document.getElementById('precio_mantenimientoM').value;
      var descripcion_mantenimiento = document.getElementById('descripcion_mantenimiento').value;

    //hacer las validaciones

    var numeros = /([0-9])/; 
    

      
    if (document.getElementById("numero_facturaM").value == '') {
      alertify.error("El número de factura es requerido");
      return;

    }else if(numero_facturaM.length > 11){
                alertify.error('El número de factura el máximo es de 11 caracteres')
                return;   
         }else if(numero_facturaM.length < 11){
                alertify.error('El número de factura el mínimo es de 11 caracteres')
                return;
              } 
                else if (!numeros.test(numero_facturaM)) {
                alertify.error("El número de factura, solo debe tener números ");
                return;
                
            }

    //Fecha facturacion
    if (document.getElementById("fecha_facturacionM").value == '') {
      alertify.error("La fecha de facturación es requerida");
      return;
    }

    //Precio de mantenimmeinto
    if (document.getElementById("precio_mantenimientoM").value == '') {
      alertify.error("El precio del mantenimeinto es requerido");
      return;
            
    }else if(precio_mantenimientoM.length < 2){
                alertify.error('El precio, mínimo debe tener 2 caracteres');
                return;
                } 
                else if (!numeros.test(precio_mantenimientoM)) {
                alertify.error("El precio solo debe tener números ");
                return;
                
            }
    
 // Descripcion
    if (document.getElementById("descripcion_mantenimiento").value == '') {
      alertify.error("La descripción es requerida");
      return;
    }



      var datosMant = {
        "id_m":id_m,
        "numero_facturaM":numero_facturaM,
        "fecha_facturacionM":fecha_facturacionM,
        "precio_mantenimientoM":precio_mantenimientoM,
        "descripcion_mantenimiento":descripcion_mantenimiento
      };
      
      $.ajax({
        type: "POST",
        url: '/guardarFacturaMantenimiento',
        data: {
            "_token": "{{ csrf_token() }}",
            "data":datosMant
        },
        success: function(data) {
          // obtenemos el resuldo retornado por la funcion del controlador, que nos retorno el cliente que anadimos
          // y ese cliente nuevo se lo agregamos a nuestra variable global,
          window.location.href = `{{URL::to('/ListadoMantenimiento')}}`;          
        }
    })

  }

  window.onload = function(){
      var fecha = new Date(); //Fecha actual
      var mes = fecha.getMonth()+1; //obteniendo mes
      var dia = fecha.getDate(); //obteniendo dia
      var ano = fecha.getFullYear(); //obteniendo año
      if(dia<10)
        dia='0'+dia; //agrega cero si el menor de 10
      if(mes<10)
        mes='0'+mes //agrega cero si el menor de 10
      document.getElementById('fecha_facturacionM').value= ano+"-"+mes+"-"+dia;

    }

</script>


@endsection
@include('common')