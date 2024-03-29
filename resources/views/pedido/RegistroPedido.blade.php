@extends('main')
@section('extra-content')

<style>
/*Los titulos */ 
.select2-container--default .select2-selection--single {
    background-color: transparent;
    border:1.3px solid black;
    border-radius: 4px;
}

  /*Cajas de texto*/ 
  .form-control  {
      background-color: transparent !important;
      border: 1.3px solid #000000 !important;
      height: fit-content !important;

  }
    /*seleccionador de producto*/
  .select{
    width: 26.5% !important;
  }
  .select1{
    width: 80% !important;
    height: 30px !important;
  }

  .select2{
    width: 85% !important;
    height: 30px !important; 
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
  background-color: #4c4d4e;;
  border: 1.3px solid #4c4d4e;;
  font-family: 'Open Sans';
  color: #FFFFFF;

}
/*Los titulos */ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #4c4d4e;;
  
  font-family: 'Open Sans';
  font-size: 20xp;
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
  color:#4c4d4e;
  font-family: 'Open Sans';
  font-size: 20px;


}

.titulo1 {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color:#4c4d4e;
  font-family: 'Open Sans';
  font-size: 40px;
  text-align: center;
}

.letra{
        font-weight: bold;
    }

.input{
	content: "";
	width: 26px;
	height: 26px;
	float: left;
	margin-right: 1em;
	border: 2px solid #ccc;
	background: rgb(94, 237, 5) !important;
	margin-top: 0.5em;
  text-align: center !important;
  vertical-align: middle !important;
} 


div.container {

width: 100% !important;
height: 100% !important;
padding-left: 10% !important;
}
</style>




{{-- Mensaje de editar (error)--}}
<script>
  var errores = []
  errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!}; 
  if(errores.length > 0){
    errores.forEach(element => {
      alertify.error(element)
    });   
  }
</script>




{{-- encabezado --}}
<div  class="form-control" >
{{-- titiulo --}}
<div style="display: flex">
  <h1 class="titulo1 mx-auto">Pedido de productos</h1>
</div>

<br>

    <div  class="input-group " style="width:100%" >

    <div style="padding-left:5%">
     <span class="input-group-text select1"  id="inputGroup-sizing-sm">Número de pedido</span>
     <input {{$accion == 'editar'?'disabled':''}}  onkeypress="ValidaSoloNumeros1()" id="numero_pedido" type="text" class="form-control select1" placeholder="ej. xxxxxxxxxxx"   maxlength="5" minlength="1">
    </div>
    <div style="padding-left: 2%">
     <span class="input-group-text select1"  id="inputGroup-sizing-sm">Fecha pedido</span>
     <input  readonly {{$accion == 'editar'?'disabled':''}} id="fecha_pedido" type="date" class="form-control select1" placeholder="Fecha del pedido">
    </div>
          
   
  
     
          &nbsp;
          @if($accion == 'editar')

          <div style="padding-left: 10%">
     <span class="input-group-text select2"  id="inputGroup-sizing-sm">Fecha recibido </span>
              <input id="fecha_recibido_pedido" type="date" class="form-control select2"  placeholder="Fecha recibido">
            </div> <br>&nbsp;&nbsp;
            <div >
              <label  for="estado_recibido">Chequear pedido</label><br>
              <input style="width: 100% "  class="input" type="checkbox" id="estado_recibido"  >
            </div>  
          @endif
   
    </div>


<br>

{{-- card datos proveedor --}}
<div class="card border-dark mb-3 form-control" style="max-width: 100rem;">
  
  <div class="card-header" style="display: flex">
    <h6 class="mx-auto letra titulo" >Datos del proveedor</h6>
  </div>

    <div class="card-body text-dark">
      <div style="display: flex" >
        @if($accion == 'crear')
          <div class="col"style="padding-left: -3%">
            <span class="input-group-text"  id="inputGroup-sizing-sm">Proveedor</span>
            <select id="selectProveedorPedido" class="form-control" onchange="getProductosProv()" style="background:transparent"> 
                <option value=>Seleccione el proveedor</option>
              @foreach ($proveedores as $pro)              
                <option value="{{$pro->id}}" >{{$pro->Nombre_empresa}}</option>
              @endforeach
            </select> 
          </div>
        @else
          <div class="col"style="padding-left: 0%">
          <span class="input-group-text"  id="inputGroup-sizing-sm">Proveedor</span>
          <input type="text" id="prov_nombre_empresa" class="form-control" placeholder="" disabled> 
          </div>
        @endif

          <div class="col"style="padding-left: 4%">
        <span class="input-group-text"  id="inputGroup-sizing-sm">Nombre del encargado</span>
        <input disabled id="prov_nombre_encargado" type="text" class="form-control" placeholder="Nombre del encargado" onkeyup="app.inputKeyUpDirect(this);">   
        </div>
      
        <div class="col"style="padding-left: 4%">
        <span class="input-group-text"  id="inputGroup-sizing-sm">Correo</span>
        <input disabled id="prov_correo" type="text" class="form-control" placeholder="Correo electrónico">
        </div>
        <div class="col"style="padding-left: 4%">
        <span class="input-group-text"  id="inputGroup-sizing-sm">Teléfono</span>
        <input disabled  id="prov_telefono" type="text" class="form-control" placeholder="Teléfono">
        </div>
      </div>
    
    
    <br>
    <div  class="select" id="divselectproduct"> 

    </div>

  </div>
</div>

<br>

{{-- card datos productos --}}
<div class="card border-dark mb-3 form-control" style="max-width: 100rem;">
    
  <div class="card-header"  style="display: flex">
    <h6 class="mx-auto letra titulo" >Datos del producto</h6>
  </div>

  <div class="card-body text-dark">
 
    <div style="display: flex">
    <div class="col"style="padding-left: 0%">
     <span class="input-group-text"  id="inputGroup-sizing-sm">Nombre</span>
     <input disabled id="producto_nombre" type="text" class="form-control " placeholder="Nombre del producto" required  onkeyup="app.inputKeyUpDirect(this);"> &nbsp;
    </div>
    <div class="col"style="padding-left: 4%">
     <span class="input-group-text"  id="inputGroup-sizing-sm">Marca</span>
     <input disabled id="producto_marca" type="text" class="form-control" placeholder="Marca del producto" required  onkeyup="app.inputKeyUpDirect(this);"> &nbsp;
    </div>
    <div class="col"style="padding-left: 4%">
     <span class="input-group-text"  id="inputGroup-sizing-sm">Descripción</span>
     <textarea disabled id="producto_descripcion" class="form-control" placeholder="Descripción" rows="1" required   onkeyup="app.inputKeyUpDirect(this);"></textarea> &nbsp;
    </div>
    <div class="col"style="padding-left: 4%">
     <span class="input-group-text"  id="inputGroup-sizing-sm">Cantidad</span>
     <input id="producto_cantidad" onkeypress="ValidaSoloNumeros2()"type="text" class="form-control" placeholder="0" maxlength="4" minlength="1"> 
    </div>
    </div>

    <br>

    <div style="display: flex">  
      <div style="display: flex" class="mx-auto">  
        <button type="button" onclick="agregarDetalleProducto()" class="button button-blue "><i class="bi bi-folder-fill"> Agregar Producto</i></button> &nbsp;
        <button {{$accion == 'editar'?'hidden':''}}  type="button" class="button button-blue " onclick="guardarPedido()" ><i class="bi bi-folder-fill"> Guardar</i></button> &nbsp;
        <button {{$accion == 'editar'?'':'hidden'}} type="button" class="button button-blue " onclick="actualizarPedido()" ><i class="bi bi-folder-fill"> Actualizar</i></button> &nbsp; 
        <a class="button button-blue "href="{{ route('index.pedido') }}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>

      </div>
    </div>

  </div>

</div>

<br>

{{-- tabla de productos agregados --}}


<div style="direction: flex" class="col-md-12 table-responsive">
  <table  class="table table-striped table-hover  border-dark bordeTabla">
      <thead>
          <tr  class="table-dark">
              <th>Nombre producto</th>
              <th>Marca</th>
              <th>Descripción</th>
              <th>Cantidad</th>
              <th>Eliminar</th>
          </tr>
      </thead>
      <tbody id="tabladetallespedido">
          </tbody>
  </table>
  </div>



<script>

// inicializamos las variables globales
 var productosprov;
 var proveedores = {!! json_encode($proveedores, JSON_HEX_TAG) !!}; 
 var detalles_pedido = {!! json_encode($detalles_pedido, JSON_HEX_TAG) !!}; 
 var accion = {!! json_encode($accion, JSON_HEX_TAG) !!}; 

 //todo esto ocurre unicamente cuando se esta editando
 if(accion == 'editar'){
  var proveedor = {!! json_encode($proveedor, JSON_HEX_TAG) !!}; 
  var pedido = {!! json_encode($pedido, JSON_HEX_TAG) !!}; 
  document.getElementById('prov_nombre_encargado').value = proveedor.Nombre_encargado
  document.getElementById('prov_correo').value = proveedor.Correo
  document.getElementById('prov_telefono').value = proveedor.Telefono_encargado
  document.getElementById('prov_nombre_empresa').value = proveedor.Nombre_empresa
  console.log(pedido.fecha_pedido);
  document.getElementById('fecha_pedido').value = pedido.fecha_pedido 
  document.getElementById('numero_pedido').value = pedido.numero_pedido 
  document.getElementById('fecha_recibido_pedido').value = pedido.fecha_recibido 
  if(pedido.estado == 1){
    document.getElementById('estado_recibido').checked = true 
  }else{
    document.getElementById('estado_recibido').checked = false     
  }

  $.ajax({
          type: "POST",
          url: '/getProductosProv',
          data: {
              "_token": "{{ csrf_token() }}",
              "data":proveedor.id
          },
          success: function(data) {
            $("#productosproveedor").remove();
            document.getElementById("divselectproduct").innerHTML = '<select name="" id="productosproveedor" class="form-control"></select>'
            
            //se le asigna el metodo que hara cuando se cambie
            $('#productosproveedor').on('select2:select', function (e) {                
              getProductdeDB(e.params.data.id)
            }); 

            //se le asignan los valores al select
            productosprov = JSON.parse(data);
            hacerselectproductosproveedor(productosprov);      
          }
      })
 }else{
  //Funcion para establecer fecha actual en la fecha de contrato, solo si estamos agregando pedido
  // NO EDITANDO
  window.onload = function(){
      var fecha = new Date(); //Fecha actual
      var mes = fecha.getMonth()+1; //obteniendo mes
      var dia = fecha.getDate(); //obteniendo dia
      var ano = fecha.getFullYear(); //obteniendo año
      if(dia<10)
        dia='0'+dia; //agrega cero si el menor de 10
      if(mes<10)
        mes='0'+mes //agrega cero si el menor de 10
      document.getElementById('fecha_pedido').value= ano+"-"+mes+"-"+dia;
    }
 }


 var producto = "nada";

 dibujarTablaDetalles();

 function hacerselectproductosproveedor(data){

      $("#productosproveedor").remove();
      document.getElementById("divselectproduct").innerHTML='<select id="productosproveedor" ><option>Seleccione un producto</option></select>'
      $('#productosproveedor').on('select2:select', function (e) {                
        getProductdeDB(e.params.data.id)
      });

      // aniadiendo un nuevo opcion
     // data.push({"text":"seleccione un producto"})

      // ordenando el id de menor a mayoy
      data = data.sort(function(a, b){  if (a.id < b.id) { return -1; } });
      $("#productosproveedor").select2({
        data: data
      });
 }

  function getProductosProv(){
    // obtenesmos el id del proveedor del select
      id_proveedor = document.getElementById('selectProveedorPedido').value ;
      let proveedor = proveedores.filter(x=> x.id == id_proveedor);

      document.getElementById("prov_nombre_encargado").value = proveedor[0].Nombre_encargado
      document.getElementById("prov_correo").value = proveedor[0].Correo
      document.getElementById("prov_telefono").value = proveedor[0].Telefono_encargado

      // buscamos los productos por proveedor en la base de datos y se lo asignamos a la variable de "productosprov"
      $.ajax({
          type: "POST",
          url: '/getProductosProv',
          data: {
              "_token": "{{ csrf_token() }}",
              "data":id_proveedor
          },
          success: function(data) {
         
            productosprov = JSON.parse(data);
            // console.log(productosprov);
           //getProductdeDB(productosprov[0].id)
           hacerselectproductosproveedor(productosprov)



          }
      })
  }

  function getProductdeDB(id_product){
    $.ajax({
          type: "POST",
          url: '/getProductosDB',
          data: {
              "_token": "{{ csrf_token() }}",
              "data":id_product
          },
          success: function(data){
            producto = JSON.parse(data);
            document.getElementById('producto_nombre').value = producto.Nombre_producto;
            document.getElementById('producto_marca').value = producto.Marca;
            document.getElementById('producto_descripcion').value = producto.Descripcion;
            document.getElementById('producto_cantidad').value = producto.Cantidad;
          }
    }); 
  }
 
      //Validaciones 
  function ValidaSoloNumeros1() {
        if ((event.keyCode < 48) || (event.keyCode > 57)) 
        event.returnValue = false;
  }

  function ValidaSoloNumeros2() {
        if ((event.keyCode < 48) || (event.keyCode > 57)) 
        event.returnValue = false;
        }
  function agregarDetalleProducto(){

    //Validaciones 

       if (document.getElementById("numero_pedido").value == '') {
                alertify.error("El número del pedido es requerido");
                return;
        }
      
        if (document.getElementById("numero_pedido").value == 0) {
                alertify.error("El número del pedido no debe ser cero");
                return;
        }
        
        if (document.getElementById("fecha_pedido").value == '') {
                alertify.error("La fecha de pedido  es requerida");
                return;
        }

      

    if(producto !=  "nada"){

      producto.Cantidad = document.getElementById('producto_cantidad').value;
      producto.id_detallepedido = uuidv4();
      producto.id_producto = producto.id

      if (document.getElementById("producto_cantidad").value == '') {
                alertify.error("La cantidad  es requerida ");
                return;
        }

      if (document.getElementById("producto_cantidad").value == 0) {
                alertify.error("La cantidad  no debe ser cero ");
                return;
        }

        // console.log(detalles_pedido);
        // console.log(producto);
        var existe = 0;
        var iddetalleactualizar = "";
        var nuevacantidad = 0;
        detalles_pedido.forEach(element => {
            if(element.id_producto == producto.id_producto){
                existe ++;
                iddetalleactualizar = element.id_detallepedido
                nuevacantidad =  (parseFloat(element.Cantidad) + parseFloat(producto.Cantidad));
                element.Cantidad = nuevacantidad
            }
        });

        if(existe == 0){
          if(accion == 'editar'){
            producto.numero_pedido = pedido.numero_pedido;
            $.ajax({
              type: "POST",
              url: '/guardarDetallePedido',
              data: {
                  "_token": "{{ csrf_token() }}",
                  "data":producto
              },
              success: function(data){
                alertify.success('Producto agregado')
              }
            }); 
          }
          detalles_pedido.push(producto);
          
        }else{
          if(accion == 'editar'){
            detalleaactualizar = {
              "iddetalleactualizar":iddetalleactualizar,
              "nuevacantidad":nuevacantidad
            }

            $.ajax({
              type: "POST",
              url: '/actualizarDetallePedido',
              data: {
                  "_token": "{{ csrf_token() }}",
                  "data":detalleaactualizar
              },
              success: function(data){
                console.log(data);
                alertify.success('Producto actualizado')
              }
            }); 
          }

        }

      producto = "nada";
      limpiarcamposproducto();
      dibujarTablaDetalles();

      
         
    }else{

      alertify.error("Selecione un producto");
    }
    hacerselectproductosproveedor(productosprov)


    
  }

  function dibujarTablaDetalles(){

    let html = ''
   
    if(detalles_pedido.length > 0){
      detalles_pedido.forEach(element => {
        html += '<div class= "box">';
        html += '<tr>'
        html += '<td>'+element.Nombre_producto+'</td>'
        html += '<td>'+element.Marca+'</td>'
        html += '<td>'+element.Descripcion+'</td>'
        html += '<td>'+element.Cantidad+'</td>'
        html += `<td><button class="btn btn-outline-dark" onclick="eliminardetalleproducto('`+element.id_detallepedido+`')"><i class="bi bi-trash"></i></button></td>`
        html += '</tr>'      
      });
    }else{
      html += '<tr><td colspan="5" style="text-align:center">No hay productos agregados</td></tr>'   
      html += '</div';  
    }
    

    document.getElementById('tabladetallespedido').innerHTML = html;
  }

  function eliminardetalleproducto(id){
    swal.fire({
                title: '¿Esta seguro que quiere eliminar el detalle pedido?',
                icon: 'question',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            },
            function(){
            // excluir el json del array, diciendole que el id sea diferente
           
            }).then((result)=>{
              if (result.isConfirmed) {
                let filtered= detalles_pedido.filter((x) => x.id_detallepedido != id);
                detalles_pedido = filtered

                if(accion == 'editar'){
                    $.ajax({
                      type: "POST",
                      url: '/eliminarDetallePedido',
                      data: {
                          "_token": "{{ csrf_token() }}",
                          "data":id
                      },
                      success: function(data){
                        
                      }
                    }); 
                }
                alertify.success('Detalle pedido eliminado')
              }  
               
                dibujarTablaDetalles()
                
            })
            event.preventDefault()
   
  }

  function guardarPedido(){       
     
        //validaciones     
        if (document.getElementById("numero_pedido").value == '') {
                alertify.error("El número del pedido es requerido");
                return;
        }      

        if (document.getElementById("numero_pedido").value == 0) {
                alertify.error("El número del pedido no debe ser cero");
                return;
        }

      
        if (document.getElementById("fecha_pedido").value == '') {
                alertify.error("La fecha de pedido  es requerida");
                return;
        }
        if (document.getElementById("selectProveedorPedido").value == '') {
                alertify.error("El proveedor es requerido");
                return;
        }


        if(detalles_pedido.length == 0 ){
                alertify.error("Debe agregar productos");
                return;
            }

          

    let datospedido = {
      "numero_pedido": document.getElementById('numero_pedido').value ,
      "fecha_pedido": document.getElementById('fecha_pedido').value ,
      "id_proveedor": document.getElementById('selectProveedorPedido').value
    };
    dataaguardar = [datospedido,detalles_pedido];
    $.ajax({
          type: "POST",
          url: '/guardarPedido',
          data: {
              "_token": "{{ csrf_token() }}",
              "data":dataaguardar
          },
          success: function(data){
            window.location.href = `{{URL::to('/pedidos')}}`;
          }
    }); 
  }

  function actualizarPedido(){   
    var fecharecibido =  document.getElementById("fecha_recibido_pedido").value
    var fechapedido = document.getElementById('fecha_pedido').value

    
    if ( fecharecibido == '') {
                alertify.error("La fecha de recibido es requerida");
                return;
    }

    if (fecharecibido == fechapedido) {
      alertify.error("La fecha de recibido no debe ser igual a la de pedido");
                return;
    }

    if (fecharecibido < fechapedido) {
      alertify.error("La fecha de recibido no debe ser menor a la de pedido");
                return;
    }

    if(detalles_pedido.length == 0 ){
                alertify.error("Debe agregar productos");
                return;
            }
   


    if(accion == 'editar'){
      let estado
      if(document.getElementById('estado_recibido').checked){
        estado = 1;

      }else{
        estado = 0
        alertify.error("Debe chequear el pedido");
                return;
      }

      let dataaActualizar = {
        "fecha_recibido_pedido":document.getElementById('fecha_recibido_pedido').value,
        "estado_recibido":estado,
        "id":pedido.id
      }
      $.ajax({
          type: "POST",
          url: '/actualizarPedido',
          data: {
              "_token": "{{ csrf_token() }}",
              "data":dataaActualizar
          },
          success: function(data){
            window.location.href = `{{URL::to('/pedidos')}}`;
            
          }
    }); 
    }
  }


  function limpiarcamposproducto(){
    document.getElementById('producto_nombre').value = "";
    document.getElementById('producto_marca').value = "";
    document.getElementById('producto_descripcion').value = "";
    document.getElementById('producto_cantidad').value = "";
  }

  function uuidv4() {
      return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
          (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
      );
  }



/* Para poner en mayuscula la primer letra*/
var app = app || {};
        
        app.toCapitalizeWords = function(text){
            return text.replace(/\w\S*/g, function(txt){
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
        }

        app.inputKeyUp = function(e){
            var value = e.target.value;
            e.target.value = app.toCapitalizeWords(value);
        }

        app.inputKeyUpDirect = function(input){
            input.value = app.toCapitalizeWords(input.value);
        }

        var inputsToCapitalizeWordsCollection = document.getElementsByClassName("toCapitalizeWords");

        for (let i = 0; i < inputsToCapitalizeWordsCollection.length; i++) {
            const element = inputsToCapitalizeWordsCollection[i];
            element.addEventListener("keyup", app.inputKeyUp);
            
        }

</script>


@endsection
{{--mensaje de confirmacion--}}
{{-- @push('alertas')
    <script>
        function actualizarPedido() {
           var formul = document.getElementById("form_guardarPD");
           
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
@endpush --}}
@include('common')