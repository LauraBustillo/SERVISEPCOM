@extends('main')
@section('extra-content')

<style>

  /*Cajas de texto*/ 
  .form-control  {
      background-color: transparent;
      border: 1.3px solid #000000;
      height: fit-content;
  }

  .form-control2  {
      background-color: rgb(238, 238, 238);
      height: fit-content;
      padding: 1rem;
      border-radius: 1rem;
  }

    /*Cajas de texto*/ 
  .form-control1  {
      background-color: white;
      border: 1.3px solid #000000;
      height: fit-content;
      padding: 1rem;
  }



  /*Alinear Div*/ 
  .divaling {
    position: relative;
    right: -4%;
  }

  /*Alinear botones*/ 
  .divalingn {
    position: relative;
    right: -8%;
  }

  /*Las label*/ 
  .input-group-text  {
    background-color: #000000;
    border: 1.3px solid #000000;
    font-family: 'Open Sans';
    color: #FFFFFF;

  }

  /*Los botones*/ 
  .btn-outline-dark {
  
    background-color: transparent;
    border: 1.8px solid #000000;
  }
  .btn-outline-dark:hover{
      background-color: rgb(48, 48, 48);
      color: white;
  }

  a { color: aliceblue;
    outline: none;
    text-decoration: none;
    color: #000000;
  }
  .a:hover{
      background-color: rgb(48, 48, 48);
      color: white;
  }
  .ancho-alto {
          width: 182%;
          height: 40%;
          resize: none;
      }

      /*Los titulos */ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color:black;
  font-family: 'Open Sans';
  font-size: 50px;
  text-align: center;
}

.titulo1 {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color:black;
  font-family: 'Open Sans';
  font-size: 30px;
  text-align: center;
}

.letra{
        font-weight: bold;
    }


.inputCliente{
  background: transparent;border: none;width:100%;outline: none;
}
.modal-content{
        background-color: rgb(184, 234, 249)!important;   
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

        
</style>


<script>
  var errores = []
  errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!}; 
  if(errores.length > 0){
    errores.forEach(element => {
      alertify.error(element)
    });   
  }
</script>

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


<script>
var tablabuscarcliente = '';
$().ready(function(){
  tablabuscarcliente =  $('#tablebuscarclientes').DataTable({
    dom:  '<"wrapper"fBlitp>',
   language:{ "sProcessing": "Procesando...",
        "sLengthMenu": "",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "",
        "sInfo": "",
        "sInfoEmpty": "",
        "sInfoFiltered": "",
        "sInfoPostFix": "",
        "sSearch": "Buscar por nombre, identidad, teléfono o dirección",
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

    buttons: []
  });
});


</script>




<form  class="form-control" method="POST" >
 
<br>
 <h1 class="titulo"> Registro de mantenimiento</h1>
<br>

@csrf

<div>
  <button {{$accion == "editar" ? "hidden" : "" }} type="button" onclick="openmodalbuscarcliente()" class="btn btn-outline-dark"  >  <i class="bi bi-search"> Buscar cliente</i></button>
  <button {{$accion == "editar" ? "hidden" : "" }} type="button" onclick="openmodalagregarcliente()" class="btn btn-outline-dark"><i class="bi bi-plus-circle"> Nuevo cliente</i></button>

  <div {{$accion == "agregar"?"hidden":""}} class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="switchestado" {{$mantenimiento->estado == "Finalizado" ? "checked" : "" }} >
    <label id="labelswitchestado" class="form-check-label" for="flexSwitchCheckDefault"> {{$mantenimiento->estado == "Finalizado" ? "Finalizado" : "Pendiente" }} </label>
  </div>  

</div>

<br>



<div {{$accion == "agregar"?"hidden":""}} id="factura_form">
  
  <div class="form-control">

    <h5 >Datos Factura</h5>

    <div style="display: flex">
      <div style="width: 100%">
        <label  id="inputGroup-sizing-sm">Número factura</label> 
        <input  id="numero_factura" type="number" minlength="3" maxlength="25" name="numero_factura" class="form-control" 
        placeholder="Numero factura" value="{{$mantenimiento->numero_factura}}">
      </div>
      &nbsp;&nbsp;     
      <div style="width: 100%">
        <label  id="inputGroup-sizing-sm">Fecha facturación</label> 
        <input  id="fecha_facturacion" type="date"  name="fecha_facturacion" class="form-control" 
        placeholder="Fecha facturacion" value="{{$mantenimiento->fecha_facturacion}}">
      </div>        
    </div>

    <div style="display: flex">
      <div style="width: 100%">
        <label  id="inputGroup-sizing-sm">Precio mantenimiento</label> 
        <input  id="precio_mantenimiento" type="text" name="precio" class="form-control" 
        placeholder="Precio mantenimiento"  value="{{$mantenimiento->precio}}">
      </div>
      &nbsp;&nbsp;   
      <div style="width: 100%">
        <label  id="inputGroup-sizing-sm">Descripcion</label> 
        <textarea  id="descripcion_mantenimiento" type="text" name="descripcion" class="form-control" 
        placeholder="Descripcion"  rows="2" value="{{$mantenimiento->descripcion}}">{{$mantenimiento->descripcion}}</textarea>
      </div>        
    </div>


  </div>

</div>

<br>

<div class="form-control"  style="width: 100%;">    
  <h5>Información Cliente</h5> 
  <input hidden readonly id="l_id_cliente" value="{{old('cliente_id')}}" name="cliente_id"/>
  <div style="display: flex">Nombre:&nbsp; <input value="{{old('Nombre',$mantenimiento->Nombre)}} {{old('Apellido',$mantenimiento->Apellido)}}" class="inputCliente" readonly id="l_nombre_cliente" name="Nombre"/></div> 
  <div style="display: flex">Identidad:&nbsp; <input value="{{old('Numero_identidad',$mantenimiento->Numero_identidad)}}" class="inputCliente" readonly id="l_identidad_cliente" name="Numero_identidad"/></div> 
  <div style="display: flex">Teléfono:&nbsp; <input value="{{old('Numero_telefono',$mantenimiento->Numero_telefono)}}"class="inputCliente" readonly id="l_telefono_cliente" name="Numero_telefono"/></div> 
  <div style="display: flex">Dirección:&nbsp; <input value="{{old('Direccion',$mantenimiento->Direccion)}}" class="inputCliente" readonly id="l_direccion_cliente" name="Direccion"/></div> 
</div>

<br>

<div class="form-control" >
  <h5>Detalles mantenimiento</h5> 
  <div style="display: flex">
    <div style="width: 100%">
    <b>  <label id="inputGroup-sizing-sm" >Categorías</label> </b>
        <select class="form-select form-control"  name="categoria" id="categoria" {{$accion == "editar" ? "disabled" : "" }} >
          <option {{ $mantenimiento->categoria == "" ? "selected" : ""}}  id= "prueba">Seleccione la categoría</option>
          <option {{ $mantenimiento->categoria == "Computadoras" ? "selected" : "" }} value="Computadoras">Computadoras</option>
          <option {{ $mantenimiento->categoria == "Impresoras" ? "selected" : "" }}  value="Impresoras">Impresoras</option>
          <option {{ $mantenimiento->categoria == "Otros"? "selected" : "" }}  value="Otros">Otros</option>
        </select>
    </div>
    &nbsp;
    &nbsp;
    <div style="width: 100%">
      <b> <label  id="inputGroup-sizing-sm">Nombre equipo</label> </b>
      <input {{$accion == "editar" ? "disabled" : "" }} value="{{old('nombre_equipo', $mantenimiento->nombre_equipo)}}" name="nombre_equipo" id="nombre_equipo" 
      type="text" aria-label="First name" class="form-control" placeholder="Nombre del equipo">
    </div>
  </div>

  <br>

  <div style="display: flex">
    <div style="width: 100%">
      <b><label id="inputGroup-sizing-sm">Marca</label> </b>
      <input {{$accion == "editar" ? "disabled" : "" }}  value="{{old('marca',$mantenimiento->marca)}}"
       name="marca" id="marca" type="text" 
      aria-label="First name" class="form-control" placeholder="Marca">
    </div>

    &nbsp;
    &nbsp;
    
    <div style="width: 100%">
      <b>    <label  id="inputGroup-sizing-sm">Modelo</label>     </b>
      <input {{$accion == "editar" ? "disabled" : "" }} value="{{old('modelo', $mantenimiento->modelo)}}" name="modelo"  id="modelo" minlength="4" maxlength="25" type="text" aria-label="Last name" class="form-control" placeholder="Modelo">
    </div>
  </div>

  <br>

  <div style="display: flex">
    <div style="width: 100%">
      <b><label  id="inputGroup-sizing-sm">Fecha ingreso</label> </b>
      <input {{$accion == "editar" ? "disabled" : "" }} value="{{old('fecha_ingreso', $mantenimiento->fecha_ingreso)}}"  name="fecha_ingreso"  id="fecha_ingreso" type="date" aria-label="First name" class="form-control" placeholder="Fecha de ingreso">
    </div> 

    &nbsp;
    &nbsp;

    <div style="width: 100%">
      <b><label  id="inputGroup-sizing-sm">Fecha entrega</label> </b>
      <input  value="{{old('fecha_entrega', $mantenimiento->fecha_entrega)}}"  name="fecha_entrega" id="fecha_entrega" type="date" aria-label="First name" class="form-control" placeholder="Fecha de entrega">
    </div> 
  </div> 

</div>

<br>
{{--Botones --}}
<center>
  <div class="col" >
  <button  class="btn btn-outline-dark" type="submit" {{$accion == "editar"?"hidden":""}} ><i class="bi bi-folder-fill"> Guardar</i></button>
  <button  class="btn btn-outline-dark" type="button" {{$accion == "agregar"?"hidden":""}} onclick="actualizarMantenimiento()"><i class="bi bi-folder-fill"> Actualizar</i></button>
  <button type="button" class="btn btn-outline-dark">
  <a class="a"  href="{{route('mantenimiento.index')}}" ><i class="bi bi-x-circle-fill"> Volver </i></a></button>
  </div>
</center>

</form>





 <!-- Modal de dialogo de agregar cliente --> 
 <div class="modal fade "  id="modalagregarcliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl" >
  <div class="modal-content">
      <div class="modal-header"><h3 class="titulo1">
          Agregar cliente
        </h3></div>
      <div class="modal-body" >
          
        
          <div style="display: flex">
    
            <div style="width: 100%">
              <label  id="inputGroup-sizing-sm">Nombres</label> 
              <input  id="nombre_cliente" type="text" minlength="3" maxlength="25" name="Nombre" pattern="[A-ZÑ a-zñ]+" class="form-control" 
              title="Solo debe tener letras"
              placeholder="Nombres" aria-label="First name" value="{{old('Nombre')}}">
            </div>
            &nbsp; &nbsp;

            <div style="width: 100%">
              <label id="inputGroup-sizing-sm">Apellidos</label> 
              <input id="apellido_cliente" type="text" minlength="4" maxlength="25" name="Apellido"  
              pattern="[A-ZÑ a-zñ]+" class="form-control" title="Solo debe tener letras" 
              placeholder="Apellidos" aria-label="Last name" value="{{old('Apellido')}}">
            </div> 

            &nbsp; &nbsp;
            <div style="width: 100%">
              <label  id="inputGroup-sizing-sm">Número de identidad</label> 
              <input uniqued id="identidad_cliente" type="text"  minlength="13" maxlength="13" name="Numero_identidad"class="form-control" 
                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" 
              title="Debe comenzar con 0 o 1. Debe tener 13 caracteres" pattern="([0-1][0-8][0-2][0-9]{10})"  pattern="[0-9]+" 
              placeholder="Eje. 0000000000000" value="{{old('Numero_identidad')}}">
            </div>

            &nbsp; &nbsp;
            <div style="width: 100%">
              <label id="inputGroup-sizing-sm">Teléfono fijo o celular</label>
              <input uniqued id="telefono_cliente"  type="text" pattern="([9,8,3,2]{1}[0-9]{7})" pattern="[0-9]+"   maxlength="8" minlength="8" name="Numero_telefono" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" 
              title="Solo debe tener numeros"   placeholder="Eje. 00000000" value="{{old('Numero_telefono')}}">
            </div> 
         
          </div>
        

          <br>
       
          <center><div style="width: 60%"> 
            <span class="input-group-text" id="inputGroup-sizing-sm">Dirección</span> 
            <textarea id="direccion_cliente"  minlength="10" maxlength="150"  name="Direccion" spellcheck="true"class="form-control" style="width: 100%"  id="exampleFormControlTextarea1"
            rows="1" placeholder="Ingrese la dirección exacta del domicilio">{{old('Direccion')}}</textarea>
          </div></center>
          
      </div>

      <!-- Botones -->
      <div class="modal-footer" style="text-align: center">
        <button  type="button" class="btn btn-outline-dark" onclick="cerrarmodalclientes()"><i class="bi bi-x-circle"> Cancelar</i></button>
        <button type="button" class="btn btn-outline-dark" style="display:block" onclick="guardarClienteBASE()" ><i class="bi bi-bag-plus"> Guardar</i></button>
      </div>
  </div>
  </div>
</div>

 <!-- Modal de dialogo de Buscar cliente --> 
 <div class="modal fade"  id="modalbuscarcliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl" >
  <div class="modal-content">
      <div class="modal-header"><h3 class="titulo1">
        Buscar cliente
      </h3></div>
      <div class="modal-body" >

          <table id="tablebuscarclientes" class="table table-hover tablacompras"> <br>  
            <thead>
              <tr>              
                <th scope="col">Nombres</th>
                <th scope="col">Identidad</th>
                <th scope="col">Teléfono </th>
                <th scope="col">Dirección </th>
                <th scope="col">Agregar cliente</th>
              </tr>
            </thead>
          
            <tbody id="tbody_buscarcliente">   
              @forelse($clientes as $cli)          
              <tr>
                <td>{{ $cli->Nombre}} {{$cli->Apellido}}</td>
                <td>{{ $cli->Numero_identidad }}</td>
                <td>{{ $cli->Numero_telefono}}</td>
                <td>{{ $cli->Direccion }}</td>                  
                <td><button class="btn btn-outline-dark"  onclick="seleccionarCliente({{$cli->id}})"><i class="bi bi-check-circle"></i></button></td>                  
              </tr>
              @empty
              @endforelse
            </tbody>
          </table> 

          <div class="modal-footer" style="text-align: center">
            <button  type="button" class="btn btn-outline-dark" onclick="cerrarmodalbuscarclientes()"><i class="bi bi-x-circle"> Cerrar</i></button>
          </div>
      </div>

  </div>
  </div>
</div>



<script>

  
// $().ready(function(){
  var accion = {!! json_encode($accion, JSON_HEX_TAG) !!}; 
  var mantenimiento = {!! json_encode($mantenimiento, JSON_HEX_TAG) !!};   
  var clientes = {!! json_encode($clientes, JSON_HEX_TAG) !!}; 
  var myModalCliente = new bootstrap.Modal(document.getElementById('modalagregarcliente'));
  var myModalbuscarCliente = new bootstrap.Modal(document.getElementById('modalbuscarcliente'));

   if(accion == "editar"){
    if(mantenimiento.estado == "Pendiente"){
      document.getElementById("factura_form").style.display = "none";      
    }

    var switchestado = document.querySelector('#switchestado');
    switchestado.addEventListener('change', function(element) {
      if(switchestado.checked){
        document.getElementById("factura_form").style.display = "block";  
        document.getElementById('labelswitchestado').innerHTML = "Finalizado";      
      }else{
        document.getElementById("factura_form").style.display = "none";
        document.getElementById('labelswitchestado').innerHTML = "Pendiente";
      }
    });
  } 

// });


  function openmodalagregarcliente(){
    myModalCliente.show();
  }
  function openmodalbuscarcliente(){
    myModalbuscarCliente.show();
  }
  function cerrarmodalclientes(){
    myModalCliente.hide();    
    limpiarcamposcliente();
  }
  function cerrarmodalbuscarclientes(){
    myModalbuscarCliente.hide();    
    limpiarcamposcliente();
  }  


  function guardarClienteBASE(){

    let nombre_cliente = document.getElementById("nombre_cliente").value;
    let apellido_cliente = document.getElementById("apellido_cliente").value;
    let identidad_cliente = document.getElementById("identidad_cliente").value;
    let telefono_cliente = document.getElementById("telefono_cliente").value;
    let direccion_cliente = document.getElementById("direccion_cliente").value;
    
    // hacer las validaciones
    var re = /^[a-zA-Z0-9 ]+$/;
    var letra= /[A-ZÑ a-zñ]/;
    var identidad= /([0-1][0-8][0-2][0-9]{10})/;
   var telefono= /([9,8,3,2]{1}[0-9]{7})/;
    // Validar Nombre
    if (nombre_cliente == '') {
                alertify.error("El nombre del cliente es requerido");
                return;
    }

   
    else if (!re.test(nombre_cliente)) {
                alertify.error("No se aceptan signos especiales");
                return;
    }
    else if (!letra.test(nombre_cliente)) {
                alertify.error("No se aceptan números");
                return;
    }

    // Validar Apellido
    if (apellido_cliente == '') {
                alertify.error("El apellido del cliente es requerido");
                return;
    } 
    else if (!re.test(apellido_cliente)) {
                alertify.error("No se aceptan signos especiales");
                return;
    } 
    else if (!letra.test(apellido_cliente)) {
                alertify.error("No se aceptan números");
                return;
    }

    // Validar Número identidad
    if (identidad_cliente == '') {
                alertify.error("El número de identidad del cliente es requerido");
                return;
    }  
    else if (!identidad.test(identidad_cliente)) {
                alertify.error("El número de identidad debe empezar con 0 o 1 y contener 13 números");
                return;
    }
   

    // Validar número télefono
    if (telefono_cliente== '') {
                alertify.error("El número de teléfono del cliente es requerido");
                return;
    } else if (!telefono.test(telefono_cliente)) {
                alertify.error("El número de teléfono debe empezar con 2, 3, 8 o 9 y contener 8 números");
                return;
    }
  

    //Validar direccion
    if (direccion_cliente == '') {
              alertify.error("La dirección del cliente es requerido");
              return;
    }
      
    let datoscliente = {
      "nombre_cliente":nombre_cliente,
      "apellido_cliente":apellido_cliente,
      "identidad_cliente":identidad_cliente,
      "telefono_cliente":telefono_cliente,
      "direccion_cliente":direccion_cliente
    };
    $.ajax({
        type: "POST",
        url: '/guardarClienteMantenimiento',
        data: {
            "_token": "{{ csrf_token() }}",
            "data":datoscliente
        },
        success: function(data) {
          clientes.push(data);     

          tablabuscarcliente
          .row.add( [ data.Nombre+' '+data.Apellido,data.Numero_identidad, data.Numero_telefono, data.Direccion,  `<button onclick="seleccionarCliente('`+data.id+`')">seleccionar</button>`] )
          .draw();

          //pasamos a los label, los datos del ultimo customer de la base de datos
          document.getElementById("l_id_cliente").value = data.id ;
          document.getElementById("l_nombre_cliente").value = data.Nombre+' '+data.Apellido;
          document.getElementById("l_identidad_cliente").value = data.Numero_identidad ;
          document.getElementById("l_telefono_cliente").value = data.Numero_telefono ;
          document.getElementById("l_direccion_cliente").value = data.Direccion ;
        }
    })
    limpiarcamposcliente();
    myModalCliente.hide();  
  }

  function limpiarcamposcliente(){
    document.getElementById("nombre_cliente").value = "";
    document.getElementById("apellido_cliente").value = "";
    document.getElementById("identidad_cliente").value = "";
    document.getElementById("telefono_cliente").value = "";
    document.getElementById("direccion_cliente").value = "";
  }

  function actualizarMantenimiento(){
    var fechaingreso = document.getElementById("fecha_ingreso").value 
    var fechaentrega = document.getElementById("fecha_entrega").value 


    //hacer las validaciones

    if (document.getElementById("nombre_equipo").value == '') {
      alertify.error("El nombre es requerido");
      return;
    }

    if (document.getElementById("marca").value == '') {
      alertify.error("La marca es requerida");
      return;
    }
    if (document.getElementById("modelo").value == '') {
      alertify.error("El modelo es requerido");
      return;
    }
    if (fechaingreso == '') {
      alertify.error("La fecha de ingreso es requerida");
      return;
    }
    if (fechaentrega == '') {
      alertify.error("La fecha de entrega es requerida");
      return;
    }

    /*if (fechaentrega == fechaingreso ) {
      alertify.error("La fecha de entrega no debe ser igual a la de ingreso");
      return;
    }*/
    if (fechaentrega < fechaingreso ) {
      alertify.error("La fecha de entrega no debe ser menor a la de ingreso");
      return;
    }
    
    var stringestado = '';
    var numero_factura = '';
    var fecha_facturacion = '';
    var precio_mantenimiento = '';
    var descripcion_mantenimiento = '';

    if(switchestado.checked){
      stringestado = "Finalizado";  
      numero_factura = document.getElementById("numero_factura").value;
      fecha_facturacion = document.getElementById("fecha_facturacion").value;
      precio_mantenimiento = document.getElementById("precio_mantenimiento").value;
      descripcion_mantenimiento = document.getElementById("descripcion_mantenimiento").value;

    }else{
      stringestado = "Pendiente";   
    }

    var datosMantenimiento = {
      

      "id":mantenimiento.id,
      "estado": stringestado,

      "numero_factura": numero_factura,
      "fecha_facturacion": fecha_facturacion,
      "precio_mantenimiento": precio_mantenimiento,
      "descripcion_mantenimiento":descripcion_mantenimiento,

      "categoria": document.getElementById("categoria").value,
      "nombre_equipo": document.getElementById("nombre_equipo").value,
      "marca": document.getElementById("marca").value,
      "modelo": document.getElementById("modelo").value,
      "fecha_ingreso": document.getElementById("fecha_ingreso").value,
      "fecha_entrega": document.getElementById("fecha_entrega").value,

      
     
    }

    $.ajax({
        type: "POST",
        url: '/actualizarMantenimiento',
        data: {
            "_token": "{{ csrf_token() }}",
            "data":datosMantenimiento
        },
        success: function(data) {
          window.location.href = `{{URL::to('/ListadoMantenimiento')}}`;
        }
    })

  }

  function seleccionarCliente(id) {
    var clientefilter = clientes.filter(x => x.id == id);
    var cliente = clientefilter[0];
    document.getElementById("l_id_cliente").value = cliente.id ;
    document.getElementById("l_nombre_cliente").value = cliente.Nombre +' '+cliente.Apellido;
    document.getElementById("l_identidad_cliente").value = cliente.Numero_identidad ;
    document.getElementById("l_telefono_cliente").value = cliente.Numero_telefono ;
    document.getElementById("l_direccion_cliente").value = cliente.Direccion ;
    myModalbuscarCliente.hide(); 
  }

  function guardar() {
    if (fechaingreso == '') {
      alertify.error("La fecha de ingreso es requerida");
      return;
    }
    if (fechaentrega == '') {
      alertify.error("La fecha de entrega es requerida");
      return;
    }

    if (fechaentrega == fechaingreso ) {
      alertify.error("La fecha de entrega no debe ser igual a la de ingreso");
      return;
    }
    if (fechaentrega < fechaingreso ) {
      alertify.error("La fecha de entrega no debe ser menor a la de ingreso");
      return;
    }
  }
  

 
</script>


@endsection
@include('common')