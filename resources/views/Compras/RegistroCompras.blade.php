@extends('main')
@section('extra-content')

<style>



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
    width: 20%;
}
.input{
    background-color: transparent;
    border: 1.8px solid #000000;
}



</style>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $mesaje)
                <li>{{ $mesaje }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br>
<br>

<form  class="form-control"  onsubmit="confirmar()">
@csrf
<br>
<br>
       {{-- Título --}}
       <H1 class="titulo" style="text-align: center;">
        @if ($accion == 'guardar')Registrar @endif
        @if ($accion == 'editar')Actualizar @endif
         
        factura de compra</H1>
        <br>
        <div style="padding-left:2%"  >
        <label  style="padding-left:3% " >Número de factura</label> 
        <input minlength="11" maxlength="11" {{ $accion == 'guardar' ? '' : 'disabled' }} onkeyup="cargarNumeroFactura()" type="text" style="position:absolute;
         right:50% " name="Numero_factura" id="Numero_factura"  aria-label="Sizing example input" onkeypress="ValidaSoloNumeros4()"
         aria-describedby="inputGroup-sizing-sm" class="input ancho" required 
         title="Solo debe contener números" value="{{old('Numero_factura')}}" >
        </div>
        <br>

    {{-- Fecha de facturación --}}
    <div style="padding-left: 5%"  >
    <label >Fecha de facturación</label>
    <input {{ $accion == 'guardar' ? '' : 'disabled' }} type="date" style="position:absolute; right:50%"  name="Fecha_facturacion" id="Fecha_facturacion" 
    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  class="input ancho"
    required  placeholder="Fecha de nacimiento" value="{{old('Fecha_facturacion')}}">
    </div>
   <br>
  
   {{-- proveedores--}}
    <div style="padding-left: 5%"   >
    <label for="Proveedores">Proveedor</label>
    <select {{ $accion == 'guardar' ? '' : 'disabled' }} style="position:absolute; right:50%" name="Proveedor" id="Proveedor"  
    class="input ancho buscador-select" style="background: transparent">
     <option value="" required [readonly]='true'>Seleccione</option>
     @foreach ($proveedores as $p)
     <option  value="{{$p->id}}" >{{$p->Nombre_empresa}}</option>         
     @endforeach
   </select> 
    </div> 
    <br>


  
    <br>

      {{--Botones --}}
       <div >
            <button  onclick="openmodal()"  class="btn btn-outline-dark" type="button">
                <i class="bi bi-file-text-fill"> Agregar Detalle </i>
            </button>
        </div>
      <br>
      <br>

    
        
          
       <table class="table table-hover"  >
        <thead>
            <h5 style="display:none" id="leyenda">Agregue datos a la factura</h5>
            <tr>
                <th>Producto</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Cantidad</th>
                <th>Precio de compra</th>
                <th>Precio de venta</th>
                <th>Impuesto</th>
                <th>Total Producto</th>
                <th>Eliminar</th>
                
            </tr>
        </thead>
        <tbody id="body_table_detallesFac">
            </tbody>
    </table>




         {{--Botones guardar y actualizar --}}
         <form action=""  id="form_guardarCo" name="form_guardarCo" method="POST"  onsubmit="confirmar()" >
         <div style="text-align: center">
            @if ($accion == 'guardar')
              <button   class="btn btn-outline-dark"  type="button" onclick="guardatFactura()" >
              <i class="bi bi-folder-fill"> Guardar</i>
              </button>  
              <button class="btn btn-outline-dark"  type="button" >
              <a class="a"  href="{{route('compra.index')}}"><i class="bi bi-x-circle"> Cerrar </i></a>
            </button>       
            @endif
        
               {{--Botones --}}
              @if ($accion == 'editar')
               <button  onclick="actualizarFactura()" class="btn btn-outline-dark"  type="button" >
               <i class="bi bi-folder-fill"> Actualizar</i>
               </button>         
               <button class="btn btn-outline-dark"  type="button" >
                <a class="a"  href="{{route('compra.index')}}"><i class="bi bi-x-circle"> Cerrar </i></a>
              </button>  
             @endif
       
              <button
              hidden
               type="button" 
               data-bs-toggle="modal" 
               data-bs-target="#staticBackdrop"
               id="openoriginalmodal"> 
              </button>
         </div>
        </form>
        </form>

          <!-- Modal de dialogo de agregar producto --> 
    <div class="modal fade"  id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl" >
          <div class="modal-content">
            <div class="modal-header">
                <h1  class="group-texto" id="staticBackdropLabel" style="text-align: center">
                    Agregar producto a la factura #<span id="numfact_form"></span> 
                </h1>    
             <label >
                <button type="submit" class="btn btn-outline-dark" href="{{route('show.registroProductos')}}" ><i class="bi bi-bag-plus"> Agregar producto</i></button>
    
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </label>
            </div>
         
            <div class="modal-body" >
                {{-- <select name="" id="cargar_prod_select" onchange="cargarProducto()" >
                    <option readonly value="">Seleccione un producto</option>
                    @foreach ($products as $p)          
                        <option value="{{$p->id_product}}">{{$p->Nombre_producto}}</option>
                    @endforeach
                </select> --}}

                            
                <div class="row">
                    <div class="col">
                        <input type="text" id="inputBuscarProveedor" onkeyup="buscarydibujarProductos()" value="" 
                        class="form-control me-2" placeholder="Buscar por nombre del producto"></div>
                    <div class="col"></div>
                </div>

                <div class="row">
                    <div class="col">
                        {{-- tabla de buscar producto --}}
                        <div id="buscar_producto_proveedor">    
                        </div>
                    </div>
                    <div class="col">
                        {{-- tabla de productosAgregados --}}
                        <div id="body_table_detallesFacModal">    
                        </div>
                    </div>
                </div>



     
                <br>
    
                <!-- Formulario de agregar producto-->
                <form action="" >   
                  
        
                     <!-- Nombre producto --> 
                    <div class="input-group input-group-sm mb-1" style="padding-right:4%"  style="width: 150%" ><br>
                    <div class="col" style="padding-left: 3%"  >
                    <label for="" class="group-text">Nombre producto</label>
                    <input disabled type="text" value="" id="nombre_producto"  name="nombre_producto"> 
                    </div>
    
                    <!-- Marca producto -->
                    <div class="col" style="padding-left: 5%"  >
                    <label for="" class="group-text" >Marca producto</label>
                    <input disabled type="text" value="" id="Marca" name="Marca">
                    </div>
    
                    <!-- Descripcion -->
                    <div class="col" style="padding-left: 2%"  >
                    <label for="" class="group-text" style="padding-right: 7%">Descripción</label>
                    <input disabled type="text" value="" style="padding-right: 2%" id="Descripcion" name="Descripcion">
                    </div>
                    </div>
                    
                        <!-- Categorias -->
                    <div class="input-group input-group-sm mb-1" style="padding-left:1.6%"  style="width:150%" ><br>
                    <div class="col" style="padding-left: 1.5%">
                    <label for="" class="group-text" style="padding-right: 14%">Categoría</label>
                    <input disabled type="text" value="" id="Categoria"  style="padding-left:25% width:30%"  name="Categoria">
                    </div>                
                    
    
                    <!-- Cantidad -->
                    <div class="col" style="padding-left:2%"  >
                    <label for="" class="group-text" style="padding-right: 14%">Cantidad</label>
                    <input type="text" value="" id="Cantidad" style=" width:54.5%" name="Cantidad" onkeypress="ValidaSoloNumeros()" >
                    </div>
    
                    <!--  Precio compra -->
                    
                        <div class="col" style="padding-right: 1.5%"  >
                        <label for="" class="group-text" style="padding-right: 1.5%" >Precio compra</label>
                        <input type="text" value="" id="Costo" style=" width:55.5%"  name="Costo" onkeypress="ValidaSoloNumeros1()">
                        </div>
                    </div>
    
                     <!-- Precio Venta -->
                    <div class="input-group input-group-sm mb-1" style="padding-left:1.6%"  style="width: 150%" ><br>
                    <div class="col" style="padding-left: 1.5%" >
                    <label for="" class="group-text" style="padding-right: 8.5%" >Precio venta</label>
                    <input type="text" value="" id="Precio_venta" style=" width:51%" name="Precio_venta" onkeypress="ValidaSoloNumeros2()">
                    </div>
       
                    <!-- Impuesto -->
                    <div class="col"style="padding-right:31%"   >
                    <label for="" class="group-text" style="padding-right:12.5%" >Impuesto</label>
                    <input type="text" value="" id="Impuesto" style=" width:51%" name="Impuesto" onkeypress="ValidaSoloNumeros3()">
                    </div>
                    </div>
                   
    
                    <input type="text" hidden  value="" name="Numero_facturaform" id="Numero_facturaform" >
                    <input type="text" hidden  value="" name="id_product" id="id_product" >
                    <input type="text" hidden  value="" name="id_prov" id="id_prov" >
                    <input type="text" hidden  value="" name="id_cat" id="id_cat" >
                    
                </form>
            </div>
            <!-- Botones -->
            <div class="modal-footer" style="text-align: center">
              <button  type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" ><i class="bi bi-x-circle"> Cerrar</i></button>
              <button type="button" class="btn btn-outline-dark" onclick="AgregarDetalle()" ><i class="bi bi-bag-plus"> Agregar</i></button>
              <button type="button" class="btn btn-outline-dark" onclick="AgregarDetalle()"  data-bs-dismiss="modal">
                <i class="bi bi-bag-x"> Agregar y cerrar</i></button>
            </div>
          </div>
        </div>
      </div>
    
      <script>


//siempre colocar para el select search en cada componente
$(document).ready(function() {
    $('.buscador-select').select2();
});
    
        var detallefactura = {!! json_encode($detallefactura, JSON_HEX_TAG) !!}; 
        var factura = {!! json_encode($factura, JSON_HEX_TAG) !!}; 
        var products = {!! json_encode($products, JSON_HEX_TAG) !!}; 
        var productfiltersProveedor;
        var totalFACTURA;   

    
            document.getElementById("Numero_factura").value = factura.Numero_factura ;
            document.getElementById("Fecha_facturacion").value = factura.Fecha_facturacion;
            totalFACTURA= factura.Total_factura;
            document.getElementById("Proveedor").value = factura.Proveedor;
    
    
    
        dibujarTabla(detallefactura);
        
        function guardatFactura() {
        
       //validaciones
       if (document.getElementById("Numero_factura").value == '') {
            alertify.error("El numero de la factura es requerido");
            return;
       }
       if (document.getElementById("Proveedor").value == '') {
            alertify.error("El proveedor es requerido");
            return;
       }
        if(detallefactura.length == 0 ){
            alertify.error("Debe de agregar detalles");
            return;
        }



        var jsonFactura = {
            Numero_factura : document.getElementById("Numero_factura").value,
            Fecha_facturacion : document.getElementById("Fecha_facturacion").value,
            Proveedor : document.getElementById("Proveedor").value,
            Total_factura : totalFACTURA,
           
        };
        
       



        var stringarrayFactura = JSON.stringify(jsonFactura);
        var stringarrayDetalles = JSON.stringify(detallefactura);
        window.location.href = `{{URL::to('/guardarFactura/`+stringarrayFactura+`/`+stringarrayDetalles+`')}}`;
        }
            
    
        function actualizarFactura() {
            var jsonFactura = {
                Numero_factura : document.getElementById("Numero_factura").value,
                Fecha_facturacion : document.getElementById("Fecha_facturacion").value,
                Proveedor : document.getElementById("Proveedor").value,
                Total_factura : totalFACTURA,
               
                id:factura.id
    
            };
            var stringarrayFactura = JSON.stringify(jsonFactura);
            var stringarrayDetalles = JSON.stringify(detallefactura);
            window.location.href = `{{URL::to('/actualizarFactura/`+stringarrayFactura+`/`+stringarrayDetalles+`')}}`;
        }
    
        function openmodal(){
            var factura = document.getElementById('Numero_factura').value;
            var proveedor = document.getElementById('Proveedor').value;
            console.log(proveedor);
            if(factura != '' && factura != undefined && factura != null){
                if(proveedor != '' && proveedor != undefined && proveedor != null){
                    productfiltersProveedor =  products.filter((x) => x.id_prov == proveedor);
                                  
                    buscarydibujarProductos();
                    cargarNumeroFactura();
                    document.getElementById('openoriginalmodal').click();
                    limpiarform();
    
    
                }else{
                alertify.error('Ingrese Factura')        

             
                }
            }else{    
                alertify.error('Ingrese Factura')   
                
            } 
        }
    
        function buscarydibujarProductos(){
            var  inputBuscarProveedor 
            inputBuscarProveedor = document.getElementById('inputBuscarProveedor').value;
    
                    productfiltersBuscador = productfiltersProveedor.filter((x) => x.Nombre_producto.toLowerCase().includes(inputBuscarProveedor.toLowerCase()));
                    html = '<table class="table table-hover" style="width: 100%";>';                
                    html += '<thead style="width: 100%;table-layout: fixed">';                
                    html += '<tr>';                
                    html += '<th>Productos</th>';                
                    html += '</tr>';                
                    html += '</thead>';                
                    html += '<tbody  style="display: inline-block; height:10rem;overflow:auto; width: 100%">';              
                    productfiltersBuscador.forEach(element => {
                    html += '<tr style="width:100%">';
                    html += '<td>' +element.Nombre_producto+'</td>';    
                    html += '<td>' +element.Marca+'</td>';    
                    html += '<td><button class="btn btn-outline-dark" onclick="cargarProducto('+element.id_product+')"><i class="bi bi-bag-plus"> Agregar</i></button></td>';   
                    html += '</tr>';                    
                    });
    
                    html += '</tbody>';   
                    html += '</table>';
    
                    document.getElementById("buscar_producto_proveedor").innerHTML = html;
        }
    
         function cargarNumeroFactura() {
            var numfactura = document.getElementById("Numero_factura").value;
    
            document.getElementById("Numero_facturaform").value = numfactura;
            document.getElementById("numfact_form").innerHTML = '<span>'+numfactura+'</span>';
    
         }
    
    
         function cargarProducto(select) {
            var productos = {!! json_encode($products, JSON_HEX_TAG) !!}; 
                // var select = document.getElementById("cargar_prod_select").value;
                if (select == '') {
                    limpiarform();
                }else{
                    pro = productos.filter((x)=> x.id_product == select)
                    document.getElementById("id_product").value = pro[0].id_product;
                    document.getElementById("id_prov").value = pro[0].id_prov;
                    document.getElementById("id_cat").value = pro[0].id_cat;
                    document.getElementById("nombre_producto").value = pro[0].Nombre_producto;
                    document.getElementById("Marca").value = pro[0].Marca;
                    document.getElementById("Descripcion").value = pro[0].Descripcion;
                    document.getElementById("Categoria").value = pro[0].DescripcionC;
                    document.getElementById("Cantidad").value = pro[0].Cantidad;
                    document.getElementById("Costo").value = pro[0].Precio_compra;
                    document.getElementById("Precio_venta").value = pro[0].Precio_venta;
                    document.getElementById("Impuesto").value = pro[0].Impuesto;
                   
                   
                }
         }
    
        function  AgregarDetalle(){
    
           var Cantidad = document.getElementById("Cantidad").value;
           var Costo = document.getElementById("Costo").value;
           var Precio_venta = document.getElementById("Precio_venta").value;
    
           if(Cantidad == '' ){
            alertify.error("La cantidad es requerida");
            return;
           }    
           if(Cantidad == 0){
            alertify.error("La cantidad no debe ser cero");
            return;
           }
           if(Costo == ''){
            alertify.error("El precio de compra es requerido");
            return;
           }
           if(Costo == 0){
            alertify.error("El precio de compra no debe ser cero");
            return;
           }           
           if(Precio_venta == ''){
            alertify.error("El precio de venta es requerida");
            return;
            }
            if(Precio_venta == 0){
            alertify.error("El precio de venta no debe ser cero");
            return;
           }

           if(Precio_venta < Costo){            
            alertify.error("El precio de venta no debe ser menor al costo");
            return;
           }else if(Precio_venta == Costo){
            alertify.error("El precio de venta no debe ser igual al costo");  
            return;          
           }
    
            var jsonproducto = {
                "id_product":  document.getElementById("id_product").value,
                "id_prov":  document.getElementById("id_prov").value,
                "id_cat":  document.getElementById("id_cat").value,
                 "Numero_facturaform":  document.getElementById("Numero_facturaform").value,
                  "nombre_producto":  document.getElementById("nombre_producto").value,
                  "Marca":  document.getElementById("Marca").value,
                  "Descripcion": document.getElementById("Descripcion").value,
                  "Categoria": document.getElementById("Categoria").value,
                  "Cantidad": Cantidad,
                  "Costo": Costo,
                  "Precio_venta": Precio_venta,
                  "Impuesto": document.getElementById("Impuesto").value,
                  
               
            };
            detallefactura.push(jsonproducto);
            dibujarTabla(detallefactura);
            limpiarform()      
    
         }
    
    
         function dibujarTabla(data){
            console.log(data);
            var html = '';
            var htmlagregados = '';
            htmlagregados +='<div><strong>Productos agregados</strong></div>'; 
                              
                              
            htmlagregados +='<div>';                    
            htmlagregados +='<div class="row" style="font-weight:bold">';               
            htmlagregados +='<div class="col">Nombre Producto </div>';                    
            htmlagregados +='<div class="col">Marca </div>';                    
            htmlagregados +='<div class="col">Cantidad </div>';                    
            htmlagregados +='</div>';        
            htmlagregados +='</div>';                    
                
                
            htmlagregados +='<div  style="height:10rem;overflow:auto">';                    

            totalFACTURA = 0;
            data.forEach(element => {
                
                totalproducto = (( element.Cantidad * element.Costo) * (1+(element.Impuesto/100)))
    
                html += '<tr>';   
                html += '<td>'+element.nombre_producto+'</td>';
                html += '<td>'+element.Marca+'</td>';
                html += '<td>'+element.Categoria+'</td>';
                html += '<td>'+element.Cantidad+'</td>';
                html += '<td>'+element.Costo+'</td>';
                html += '<td>'+element.Precio_venta+'</td>';
                html += '<td>'+element.Impuesto+'</td>';
                html += '<td>'+totalproducto.toFixed()+'</td>';
                html += '<td><button class="btn btn-outline-dark">Eliminar</button></td>';
                html += '</tr>';

                htmlagregados +='<div  class="row">';                    
                htmlagregados += '<div class="col">'+element.nombre_producto+'</div>';
                htmlagregados += '<div class="col">'+element.Marca+'</div>';
                htmlagregados += '<div class="col">'+element.Cantidad+'</div>';
                htmlagregados +='</div>';
    
                totalFACTURA += totalproducto;
            });

            htmlagregados +='</div>';                    



                html += '<tr>';               
                html += '<td></td> <td></td> <td></td> <td></td> <td></td> <td></td>';
                html += '<td><strong >Total factura</strong></td>';
                html += '<td><strong>'+totalFACTURA.toFixed()+'</strong></td><td></td>';
                html += '<tr>';
            document.getElementById('body_table_detallesFac').innerHTML = html;
            document.getElementById('body_table_detallesFacModal').innerHTML = htmlagregados;
    
         }
    
         function limpiarform(){        
            document.getElementById("nombre_producto").value = '';
            document.getElementById("Marca").value ='';
            document.getElementById("Descripcion").value = '';
            document.getElementById("Categoria").value ='';
            document.getElementById("Cantidad").value = 1;
            document.getElementById("Costo").value ='';
            document.getElementById("Precio_venta").value ='';
            document.getElementById("Impuesto").value =15;
            document.getElementById("id_product").value ='';
            document.getElementById("id_prov").value ='';
            document.getElementById("id_cat").value ='';
            document.getElementById("inputBuscarProveedor").value = '';
         }
    
        //  {{-- para no escribir numeros --}}
         function ValidaSoloNumeros() {
        if ((event.keyCode < 48) || (event.keyCode > 57)) 
        event.returnValue = false;
        }
        function ValidaSoloNumeros1() {
        if ((event.keyCode < 48) || (event.keyCode > 57)) 
        event.returnValue = false;
        }
        function ValidaSoloNumeros2() {
        if ((event.keyCode < 48) || (event.keyCode > 57)) 
        event.returnValue = false;
        }
        function ValidaSoloNumeros3() {
        if ((event.keyCode < 48) || (event.keyCode > 57)) 
        event.returnValue = false;
        }
        function ValidaSoloNumeros4() {
        if ((event.keyCode < 48) || (event.keyCode > 57)) 
        event.returnValue = false;
        }
    
    
            
     </script>
    
    @endsection
           {{--mensaje de confirmacion --}}
    @push('alertas')
        <script>
            function confirmar() {
               var formul = document.getElementById("form_guardarCo");
               
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
       