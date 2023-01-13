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
      background-color: rgb(145, 203, 223);
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




  /* Este elemento debe tener "position: relative" */
  div#is-relative{
  max-width: 800px;
  position: relative;

  }

  /* El icono debe ser "position: absolute"
  * Ademas le damos un "display: block" y lo posicionamos */
  #icon{
  position: absolute;
  display: block;
  bottom: .5rem;
  left: 1rem;

  user-select: none;
  cursor: pointer;
  }


  input.input[type='file']#foto{
  padding-left: 2.5rem;
  background-color:rgb(241, 237, 237);
  border: 1.3px solid #000000;
  height: 40px;
  width: 100% !important;
  color: rgb(11, 11, 11);
  filter: alpha(opacity=2);
    opacity: 1;
    content: "";

  }

   
</style>
{{-- alertas de errores desde controlador --}}
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
 let tablabuscarclienterep ='';
    $().ready(function(){
      tablabuscarclienterep =  $('#tablebuscarclientesrep').DataTable({
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

      var tableinv = $('#tablebuscarinventario').DataTable({
        language:{ "sProcessing": "Procesando...",
              "sLengthMenu": "",
              "sZeroRecords": "No se encontraron resultados",
              "sEmptyTable": "",
              "sInfo": "",
              "sInfoEmpty": "",
              "sInfoFiltered": "",
              "sInfoPostFix": "",
              "sSearch": "Buscar por categoria, marca y nombre producto",
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

    
    



<form  class="form-control" method="POST"  id="form_guardarR" name="form_guardarR" onsubmit="guardarReparacion();">
 
    <br>
     <H1 class="titulo" style="text-align: center;">
      @if ($accion == 'agregar')Registrar @endif
      @if ($accion == 'editar')Actualizar @endif         
        reparación</H1>
    <br>
    
    @csrf
   
    
    <div>
      <button {{$accion == "editar" ? "hidden" : "" }} type="button" onclick="openmodalbuscarcliente()" class="btn btn-outline-dark"><i class="bi bi-search"> Buscar cliente</i></button>
      <button {{$accion == "editar" ? "hidden" : "" }} type="button" onclick="openmodalagregarcliente()" class="btn btn-outline-dark"><i class="bi bi-plus-circle"> Nuevo cliente</i></button>
   
        {{-- este checkbox solo se mostrara en  editar --}}
      <div {{$accion == "agregar"?"hidden":""}} class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="switchestado_rep" {{$reparacion->estado == "Finalizado" ? "checked" : "" }} >
        <label id="labelswitchestado_rep" class="form-check-label" for="flexSwitchCheckDefault"> {{$reparacion->estado == "Finalizado" ? "Finalizado" : "Pendiente" }} </label>
      </div>  
    </div>

    <br>

{{-- esta seccion solo se motrara en editar --}}
 {{-- con este formulario, agregaremos los campos de la factura en la misma tabla de mantenimiento --}}
 <div {{$accion == "agregar"?"hidden":""}} id="factura_form_rep">
  
  <div class="form-control2" {{$accion == "editar"?"hidden":""}}>
    <h5 >Datos Factura</h5>

    <div style="display: flex">
      <div style="width: 100%">
        <label  id="inputGroup-sizing-sm">Número factura</label> 
        <input  id="numero_factura_rep" type="number" minlength="3" maxlength="25" name="numero_factura_rep" class="form-control" 
        placeholder="Numero factura" value="{{$reparacion->numero_factura}}">
      </div>
      &nbsp;&nbsp;     
      <div style="width: 100%">
        <label  id="inputGroup-sizing-sm">Fecha facturación</label> 
        <input  id="fecha_facturacion_rep" type="date"  name="fecha_facturacion_rep" class="form-control" 
        placeholder="Fecha facturacion" value="{{$reparacion->fecha_factura}}">
      </div>        
    </div>

    <div style="display: flex">
      <div style="width: 100%">
        <label  id="inputGroup-sizing-sm">Precio reparacion</label> 
        <input  id="precio_rep" type="text" name="precio_rep" class="form-control" 
        placeholder="Precio reparacion"  value="{{$reparacion->precio}}">
      </div>
      &nbsp;&nbsp;   
      <div style="width: 100%">
        <label  id="inputGroup-sizing-sm">Descripcion</label> 
        <textarea  id="descripcion_rep" type="text" name="descripcion_rep" class="form-control" 
        placeholder="Descripcion"  rows="2" value="{{$reparacion->descripcion}}">{{$reparacion->descripcion}}</textarea>
      </div>        
    </div>


  </div>

</div>

    <br>
   
    <div class="form-control2" style="display: flex">    
       
      <div style="width: 50%;">
        <h5>Información Cliente</h5> 
         <input hidden readonly id="l_id_cliente" value="{{old('cliente_id')}}" name="cliente_id"/>
         <div style="display: flex">Nombre:&nbsp; <input value="{{old('Nombre',$reparacion->Nombre)}} {{old('Apellido',$reparacion->Apellido)}}" class="inputCliente" readonly id="l_nombre_cliente" name="Nombre"/></div> 
         <div style="display: flex">Identidad:&nbsp; <input value="{{old('Numero_identidad',$reparacion->Numero_identidad)}}" class="inputCliente" readonly id="l_identidad_cliente" name="Numero_identidad"/></div> 
         <div style="display: flex">Teléfono:&nbsp; <input value="{{old('Numero_telefono',$reparacion->Numero_telefono)}}"class="inputCliente" readonly id="l_telefono_cliente" name="Numero_telefono"/></div> 
         <div style="display: flex">Dirección:&nbsp; <input value="{{old('Direccion',$reparacion->Direccion)}}" class="inputCliente" readonly id="l_direccion_cliente" name="Direccion"/></div> 
      </div>
      <br>
      <br>
  
    </div>
      
      <br>


      <div class="form-control2" >
        <h5>Detalles reparación</h5> 
        <div style="display: flex">
          <div style="width: 100%">
          <b>  <label id="inputGroup-sizing-sm" >Categorías</label> </b>
              <select class="form-select form-control"  name="categoria" id="categoria" {{$accion == "editar" ? "disabled" : "" }} >
                <option {{ $reparacion->categoria == "" ? "selected" : ""}} value="{{null}}" id= "prueba">Seleccione la categoría</option>
                <option {{ $reparacion->categoria == "Computadoras" ? "selected" : "" }} value="Computadoras">Computadoras</option>
                <option {{ $reparacion->categoria == "Impresoras" ? "selected" : "" }}  value="Impresoras">Impresoras</option>
                <option {{ $reparacion->categoria == "Otros"? "selected" : "" }}  value="Otros">Otros</option>
              </select>
          </div>
          &nbsp;
          &nbsp;
      
          {{-- Nombre equipo--}}
          <div style="width: 100%">
            <b> <label  id="inputGroup-sizing-sm">Nombre equipo</label> </b>
            <input {{$accion == "editar" ? "disabled" : "" }} value="{{old('nombre_equipo', $reparacion->nombre_equipo)}}" name="nombre_equipo" id="nombre_equipo"  maxlength="20" 
            type="text" aria-label="First name" class="form-control" placeholder="Nombre del equipo">
          </div>
        </div>
      
        <br>
      
        {{-- Marca --}}
        <div style="display: flex">
          <div style="width: 100%">
            <b><label id="inputGroup-sizing-sm">Marca</label> </b>
            <input {{$accion == "editar" ? "disabled" : "" }}  value="{{old('marca',$reparacion->marca)}}"
             name="marca" id="marca" type="text" 
            aria-label="First name" class="form-control" placeholder="Marca" maxlength="20" >
          </div>
      
          &nbsp;
          &nbsp;
          
          {{-- Modelo --}}
          <div style="width: 100%">
            <b>    <label  id="inputGroup-sizing-sm">Modelo</label>     </b>
            <input {{$accion == "editar" ? "disabled" : "" }} value="{{old('modelo', $reparacion->modelo)}}" name="modelo"  id="modelo"  maxlength="20" type="text" aria-label="Last name" class="form-control" placeholder="Modelo">
          </div>
        </div>


        {{-- Descripcion --}}
        <div style="display: flex">
         <div style="width: 50%">
            <b> <label  id="inputGroup-sizing-sm">Descripción</label> </b>
            <textarea {{$accion == "editar" ? "disabled" : "" }}  name="descripcionr" id="descripcionr"  maxlength="200" 
            type="text" aria-label="First name" class="form-control" rows="1"  placeholder="Descripción del equipo">{{old('descripcionr', $reparacion->descripcionr)}}</textarea>
          </div>

          &nbsp;
          &nbsp;
          
          {{-- Foto--}}
          <br><br><br><br>
          <div style="width: 50%"> 
            <b> <label  id="inputGroup-sizing-sm">Fotos</label> </b>

            <div id="is-relative" >
         
              <input  class="input form-control" {{$accion == "editar" ? "hidden" : "" }} class="form-control form-control-lg" id="selectAvatar" type="file" multiple /> &nbsp;
              <div style="display: flex;">
                <img {{$accion == "editar" && $reparacion->foto == null?"hidden":""}}  class="img" id="avatar"  style="width: 4rem;height:4rem" /> &nbsp;
                <img {{$accion == "editar" && $reparacion->foto1 == null?"hidden":""}}  class="img" id="avatar1"  style="width: 4rem;height:4rem" />&nbsp;
                <img {{$accion == "editar" && $reparacion->foto2 == null?"hidden":""}}  class="img" id="avatar2"  style="width: 4rem;height:4rem" />&nbsp;
                <img {{$accion == "editar" && $reparacion->foto3 == null?"hidden":""}}  class="img" id="avatar3"  style="width: 4rem;height:4rem" />&nbsp;
                <img {{$accion == "editar" && $reparacion->foto4 == null?"hidden":""}}  class="img" id="avatar4"  style="width: 4rem;height:4rem" />&nbsp;
              </div>
            
              <textarea name="foto" id="textArea" hidden></textarea>
              <textarea name="foto1"  id="textArea1" hidden></textarea>
              <textarea name="foto2" id="textArea2" hidden></textarea>
              <textarea name="foto3"  id="textArea3" hidden></textarea>
              <textarea name="foto4"  id="textArea4" hidden></textarea>
            </div>

                

          </div>
        </div>
<br>
   

    <div style="display: flex" >
      
      <div class="form-check form-switch">
        <label >Cambio de pieza</label>
        <input style="display:flex;" class="form-check-input" type="checkbox" id="switchCambioPieza" name="switchCambioPieza" {{$reparacion->cambio_pieza == "Si" ? "checked" : "" }} >
      </div>
    </div> 
    
    <div id="abririnventario" >
      <div style="display: flex" >
        <button  class="btn btn-outline-dark" type="button" onclick="openabririnventario()"> Ver inventario </button>
        &nbsp;
        &nbsp;
        {{-- Nombre equipo--}}
        <div style="width: 100%">
          <b> <label  id="inputGroup-sizing-sm">Categoria</label> </b>
          <input  value="{{$reparacion->categoria_producto_inv}}" name="categoria_producto_inv" id="categoria_producto_inv"  maxlength="20" 
          type="text" class="form-control" placeholder="Categoria">
        </div>
        &nbsp;
        &nbsp;

        {{-- Nombre equipo--}}
        <div style="width: 100%">
          <b> <label  id="inputGroup-sizing-sm">Marca</label> </b>
          <input  value="{{ $reparacion->marca_producto_inv}}" name="marca_producto_inv" id="marca_producto_inv"  maxlength="20" 
          type="text" class="form-control" placeholder="Nombre del equipo">
        </div>
        &nbsp;
        &nbsp;
        {{-- Nombre equipo--}}
        <div style="width: 100%">
          <b> <label  id="inputGroup-sizing-sm">Nombre producto</label> </b>
          <input  value="{{ $reparacion->nombre_producto_inv}}" name="nombre_producto_inv" id="nombre_producto_inv"  maxlength="20" 
          type="text" class="form-control" placeholder="Nombre Producto">
        </div>

        <input hidden  value="{{$reparacion->id_producto_inv}}" name="id_producto_inv" id="id_producto_inv" >
      </div>

      <div>
        <div class="form-check form-switch">
          <label >Garantia</label>
          <input style="display:flex;" class="form-check-input" onchange="changeswitchGarantia()" type="checkbox" id="switchGarantia" name="switchGarantia" {{$reparacion->garantia == "Si" ? "checked" : "" }} >
        </div>
      </div>
    </div>
      
    <br>
      
    {{-- Fecha ingreso  --}}
    <div style="display: flex">
      <div style="width: 100%">
        <b><label id="inputGroup-sizing-sm">Fecha ingreso</label> </b>
        <input {{$accion == "editar" ? "disabled" : "" }} value="{{old('fecha_ingreso', $reparacion->fecha_ingreso)}}"  name="fecha_ingreso"  id="fecha_ingreso" type="date" aria-label="First name" class="form-control" placeholder="Fecha de ingreso">
      </div> 
  
      &nbsp;
      &nbsp;
  
  
        {{-- Fecha entrega  --}}
      <div style="width: 100%">
        <b><label  id="inputGroup-sizing-sm">Fecha entrega</label> </b>
        <input  value="{{old('fecha_entrega', $reparacion->fecha_entrega)}}"  name="fecha_entrega" id="fecha_entrega" type="date" aria-label="First name" class="form-control" placeholder="Fecha de entrega">
      </div> 
    </div> 
      
        
      
      </div>
      
      <br>
      {{--Botones --}}
      <center>
        <div class="col" >
          <button  class="btn btn-outline-dark" type="submit" {{$accion == "editar"?"hidden":""}} onclick="fecha();"><i class="bi bi-folder-fill"> Guardar</i></button>
          <button type="button"  onclick="clickactualizarReparacion()" class="btn btn-outline-dark"  {{$accion == "editar"?"":"hidden"}} ><i class="bi bi-folder-fill"> Actualizar</i></button>
          <button type="button" class="btn btn-outline-dark">
          <a class="a"  href="{{route('reparacion.index')}}" ><i class="bi bi-x-circle-fill"> Volver </i></a></button>
          </div>
      </center>
        
      
      </form>

 <!-- Modal de dialogo de Buscar cliente --> 
 <div class="modal fade"  id="modalbuscarcliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl" >
    <div class="modal-content">
        <div class="modal-header"><h3 class="titulo1">
          Buscar cliente
        </h3></div>
        <div class="modal-body" >
  
            <table id="tablebuscarclientesrep" class="table table-hover tablacompras"> <br>  
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

 <!-- Modal de dialogo de agregar cliente --> 
 <div class="modal fade "  id="modalagregarproductoinventario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl" >
  <div class="modal-content">
      <div class="modal-header">
        <h3 class="titulo1">Agregar Producto Invantario</h3>
      </div>

      <table id="tablebuscarinventario" class="table table-hover tablacompras"> <br>  
        <thead>
          <tr>              
            <th scope="col">Categoria</th>
            <th scope="col">Marca</th>
            <th scope="col">Nombre Producto </th>
            <th scope="col">Cantidad </th>
            <th scope="col">Agregar</th>
          </tr>
        </thead>
      
        <tbody id="tbody_buscarcliente">   
          @forelse($inventario as $in)          
          <tr>
            <td>{{ $in->Categoria}} </td>
            <td>{{ $in->Marca }}</td>
            <td>{{ $in->Nombre_producto}}</td>
            <td>{{ $in->Cantidad }}</td>                  
            <td><button class="btn btn-outline-dark" type="button" onclick="agregarproductoInventario({{$in->id_producto}})"><i class="bi bi-check-circle"></i></button></td>                  
          </tr>
          @empty
          @endforelse
        </tbody>
      </table> 
      

      <!-- Botones -->
      <div class="modal-footer" style="text-align: center">
        <button  type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"><i class="bi bi-x-circle"> Cancelar</i></button>
      </div>
  </div>
  </div>
</div>


<script>












    //ocultar y esconder, boton de inventario
    var switchCambioPieza = document.querySelector('#switchCambioPieza');
    if(switchCambioPieza.checked){
      document.getElementById("abririnventario").style.display = "block";  
    }else{
      document.getElementById("abririnventario").style.display = "none";
    }
  switchCambioPieza.addEventListener('change', function(element) {
    if(switchCambioPieza.checked){
      document.getElementById("abririnventario").style.display = "block";  
    }else{
      document.getElementById("abririnventario").style.display = "none";
    }
  });

const input = document.getElementById("selectAvatar");

const avatar = document.getElementById("avatar");
const avatar1 = document.getElementById("avatar1");
const avatar2 = document.getElementById("avatar2");
const avatar3 = document.getElementById("avatar3");
const avatar4 = document.getElementById("avatar4");
const textArea = document.getElementById("textArea");
const textArea1 = document.getElementById("textArea1");
const textArea2 = document.getElementById("textArea2");
const textArea3 = document.getElementById("textArea3");
const textArea4 = document.getElementById("textArea4");

const convertBase64 = (file) => {
    return new Promise((resolve, reject) => {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(file);

        fileReader.onload = () => {
            resolve(fileReader.result);
        };

        fileReader.onerror = (error) => {
            reject(error);
        };
    });
};

const uploadImage = async (event) => {
  for(let i =0;i < event.target.files.length;i++){
    const file = event.target.files[i];
    const base64 = await convertBase64(file);

    if(i == 0){      
      avatar.src = base64;
      textArea.innerText = base64;
    }
    if(i == 1){      
      avatar1.src = base64;
      textArea1.innerText = base64;
    }
    if(i == 2){      
      avatar2.src = base64;
      textArea2.innerText = base64;
    }
    if(i == 3){      
      avatar3.src = base64;
      textArea3.innerText = base64;
    }
    if(i == 4){      
      avatar4.src = base64;
      textArea4.innerText = base64;
    }
  }

};

input.addEventListener("change", (e) => {
    uploadImage(e);
});



    //funcion para guardar cliente en el modal
  var accion = {!! json_encode($accion, JSON_HEX_TAG) !!}; 
  var reparacion = {!! json_encode($reparacion, JSON_HEX_TAG) !!};   
  var inventario = {!! json_encode($inventario, JSON_HEX_TAG) !!};
  var clientes = {!! json_encode($clientes, JSON_HEX_TAG) !!}; 
  var myModalCliente = new bootstrap.Modal(document.getElementById('modalagregarcliente'));
  var myModalbuscarCliente = new bootstrap.Modal(document.getElementById('modalbuscarcliente'));
  var myModalagregarproductoinventario = new bootstrap.Modal(document.getElementById('modalagregarproductoinventario'));



  // cuando sea la aciion de editar declararemos otras variables globales como ser
// switchestado: que sera con el cual mostraremos y ocultaremos la seccion de la factura
if(accion == "editar"){

// si inicialmente el estado de la factura es pendiente, ocultaremos la seccion de la factura
if(reparacion.estado == "Pendiente"){
  document.getElementById("factura_form_rep").style.display = "none";      
}

// obtendremos el checkbox con JQuery, y obtendremos cada cambio que se realize en el 
// con el evento change,
var switchestado = document.querySelector('#switchestado_rep');
if(switchestado.checked){
    document.getElementById("factura_form_rep").style.display = "block";  
    document.getElementById('labelswitchestado_rep').innerHTML = "Finalizado";      
  }else{
    document.getElementById("factura_form_rep").style.display = "none";
    document.getElementById('labelswitchestado_rep').innerHTML = "Pendiente";
  }
switchestado.addEventListener('change', function(element) {
  // verificamos el estado del checkbox, si esta chequeado osea true,
  // mostraremos la factura dando un estilo de display bloc a la seccion
  // y al label a la par del checkbox le daremos el valor con innerHTML de finalezado
  if(switchestado.checked){
    document.getElementById("factura_form_rep").style.display = "block";  
    document.getElementById('labelswitchestado_rep').innerHTML = "Finalizado";      
  }else{
    
    // en caso de ser falso
    // ocualtaremos la seccion 
    // y le colocaremos pendiente al label
    document.getElementById("factura_form_rep").style.display = "none";
    document.getElementById('labelswitchestado_rep').innerHTML = "Pendiente";
  }
  
});
}   

function fecha(){
    var fechaingreso = document.getElementById("fecha_ingreso").value 
    var fechaentrega = document.getElementById("fecha_entrega").value 


    if (fechaentrega < fechaingreso ) {
      alertify.error("La fecha de entrega no debe ser menor a la de ingreso");
      return;
    }
  }
  

  function clickactualizarReparacion(){
    var fechaingreso = document.getElementById("fecha_ingreso").value;
    var fechaentrega = document.getElementById("fecha_entrega").value ;

    var categoria_producto_inv = document.getElementById("categoria_producto_inv").value ;
    var marca_producto_inv = document.getElementById("marca_producto_inv").value ;
    var nombre_producto_inv = document.getElementById("nombre_producto_inv").value ;
    var id_producto_inv = document.getElementById("id_producto_inv").value ;
    var switchGarantia = document.getElementById("switchGarantia").checked ;


    if (fechaingreso == '') {
      alertify.error("La fecha de ingreso es requerida");
      return;
    }
    if (fechaentrega == '') {
      alertify.error("La fecha de entrega es requerida");
      return;
    }
 
    if (fechaentrega < fechaingreso ) {
      alertify.error("La fecha de entrega no debe ser menor a la de ingreso");
      return;
    }
   
      // verificamos cual es el estado del checkbox y si es verdadero, significa que la factura esta abierta y si podra obtener los valores de la factura
    // si esta cerrada nos tira el error que no halla esos inputs
    let  stringestado = '';
    if(switchestado.checked){
      stringestado = "Finalizado";  
    }else{
      stringestado  = "Pendiente";   
    }  

    let  stringcambio_pieza = '';
    if(switchCambioPieza.checked){
      stringcambio_pieza = "Si";  
    }else{
      stringcambio_pieza  = "No";   
    }  
    let  string_garantia = '';
    if(switchGarantia){
      string_garantia = "Si";  
    }else{
      string_garantia  = "No";   
    }  

    // armamos el jason, que mandaremos en la ruta
     let datosReparacion = {      
     
      "id":reparacion.id,

      "estado": stringestado,
      "numero_factura": document.getElementById("numero_factura_rep").value,
      "fecha_factura": document.getElementById("fecha_facturacion_rep").value,
      "precio": document.getElementById("precio_rep").value,
      "descripcion": document.getElementById("descripcion_rep").value,

      "cambio_pieza": stringcambio_pieza,
      "categoria_producto_inv": categoria_producto_inv  ,
      "marca_producto_inv": marca_producto_inv,
      "nombre_producto_inv":nombre_producto_inv,    
      "id_producto_inv": id_producto_inv,
      "garantia": string_garantia,   
     
      "fecha_ingreso": document.getElementById("fecha_ingreso").value,
      "fecha_entrega": document.getElementById("fecha_entrega").value,   
     
    }
    
    
    $.ajax({
        type: "POST",
        url: '/actualizarReparacion',
        data: {
            "_token": "{{ csrf_token() }}",
            "data":datosReparacion
        },
        success: function(data) {
          window.location.href = `{{URL::to('/ListadoReparacion')}}`;
        }
    })

  }


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

// cuando sea la aciion de editar declararemos otras variables globales como ser
// switchestado: que sera con el cual mostraremos y ocultaremos la seccion de la factura
if(accion == "agregar"){
  
  document.getElementById("btninventario").style.display = "none"; 


// obtendremos el checkbox con JQuery, y obtendremos cada cambio que se realize en el 
// con el evento change,
var switchestado = document.querySelector('#switchestado');
switchestado.addEventListener('change', function(element) {
  // verificamos el estado del checkbox, si esta chequeado osea true,
  // mostraremos la factura dando un estilo de display bloc a la seccion
  // y al label a la par del checkbox le daremos el valor con innerHTML de finalezado
  if(switchestado.checked){
    document.getElementById("btninventario").style.display = "block";  
    document.getElementById('labelswitchestado').innerHTML = "Si";      
  }else{
    // en caso de ser falso
    // ocualtaremos la seccion 
    // y le colocaremos pendiente al label
    document.getElementById("btninventario").style.display = "none";
    document.getElementById('labelswitchestado').innerHTML = "No";
  }
});
} 

if(accion == "editar"){
  avatar.src = reparacion.foto;
  avatar1.src = reparacion.foto1;
  avatar2.src = reparacion.foto2;
  avatar3.src = reparacion.foto3;
  avatar4.src = reparacion.foto4;
}
  
  
  function guardarClienteBASE(){

    let nombre_cliente = document.getElementById("nombre_cliente").value;
    let apellido_cliente = document.getElementById("apellido_cliente").value;
    let identidad_cliente = document.getElementById("identidad_cliente").value;
    let telefono_cliente = document.getElementById("telefono_cliente").value;
    let direccion_cliente = document.getElementById("direccion_cliente").value;
    
    // hacer las validaciones
    var re = /^[A-ZÑ a-zñ]+$/;
    var letra= /[A-ZÑ a-zñ]/;
    var identidad= /([0-1][0-8][0-2][0-9]{10})/;
   var telefono= /([9,8,3,2]{1}[0-9]{7})/;
    // Validar Nombre
    if (nombre_cliente == '') {
                alertify.error("El nombre del cliente es requerido");
                return;
    }

   
    else if (!re.test(nombre_cliente)) {
                alertify.error("No se aceptan signos especiales y números");
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
                alertify.error("No se aceptan signos especiales y números");
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
    if (identidad_cliente == 0) {
                alertify.error("El número de identidad del cliente no debe ser cero");
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
    
    // la "clientes" tenemos todos los clientes de la base de datos cliente
    // vamos a verificar el campo de telefono de todos los cliente, a ver si hay un telefono exacatmente igual
    console.log(clientes);
    var existeTel  = 0;
    var existeIden  = 0;
    clientes.forEach(element => {
        
      if(element.Numero_identidad == identidad_cliente){
        existeIden = existeIden +1;
      }   
      if(element.Numero_telefono == telefono_cliente){
        existeTel = existeTel +1;
      } 
    });

    if(existeIden > 0){
      alertify.error("La identidad ya existe");
      return;
    }
    if(existeTel > 0){
      alertify.error("El telefono ya existe");
      return;
    }

   
  

    //Validar direccion
    if (direccion_cliente == '') {
              alertify.error("La dirección del cliente es requerida");
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
        url: '/guardarClienteReparacion',
        data: {
            "_token": "{{ csrf_token() }}",
            "data":datoscliente
        },
        success: function(data) {
          
          clientes.push(data);     
          
       
          //pasamos a los label, los datos del ultimo customer de la base de datos
          document.getElementById("l_id_cliente").value = data.id ;
          document.getElementById("l_nombre_cliente").value = data.Nombre+' '+data.Apellido;
          document.getElementById("l_identidad_cliente").value = data.Numero_identidad ;
          document.getElementById("l_telefono_cliente").value = data.Numero_telefono ;
          document.getElementById("l_direccion_cliente").value = data.Direccion ;
          tablabuscarclienterep.row.add( [ data.Nombre+' '+data.Apellido,data.Numero_identidad, data.Numero_telefono, data.Direccion,
          `<button class="btn btn-outline-dark" onclick="seleccionarCliente('`+data.id+`')"><i class="bi bi-check-circle"></i></button>`] )
          .draw();
        }
    })
    limpiarcamposcliente();
    myModalCliente.hide();  
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

  function limpiarcamposcliente(){
    document.getElementById("nombre_cliente").value = "";
    document.getElementById("apellido_cliente").value = "";
    document.getElementById("identidad_cliente").value = "";
    document.getElementById("telefono_cliente").value = "";
    document.getElementById("direccion_cliente").value = "";
  }






   function agregarproductoInventario(id_producto){
    let producto = inventario.filter(x => x.id_producto == id_producto)
    document.getElementById('categoria_producto_inv').value = producto[0].Categoria ;
    document.getElementById('marca_producto_inv').value = producto[0].Marca ;
    document.getElementById('nombre_producto_inv').value = producto[0].Nombre_producto ;
    document.getElementById('id_producto_inv').value = producto[0].id_producto ;
    myModalagregarproductoinventario.hide()    
  }

  function openabririnventario(){
    myModalagregarproductoinventario.show()
  }


</script>


@endsection


 {{--mensaje de confirmacion --}}
 @push('alertas')
 <script>
    function guardarReparacion() {
       var formul = document.getElementById("form_guardarR");
       
       Swal.fire({
            title: '¿Está seguro que desea guardar los datos?',
            icon: 'question',
            confirmButtonColor: '#3085d6',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result)=>{
            if (result.isConfirmed) {
                formul.submit();
            }
        })
        event.preventDefault()
    }
</script> 
@endpush
@include('common')