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


<script>
    var errores = []
    errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!};
    if(errores.length > 0){
      errores.forEach(element => {
        alertify.error(element)
      });
    }

  </script>


<br>
<br>


{{-- <form  class="form-control"    name="form_guardarCompra" id="form_guardarCompra" method="POST" onsubmit="guardarcompra()" > --}}
<form  class="form-control"    name="form_guardarCompra" >
    <br>
       {{-- Título --}}
       <H1 class="titulo" style="text-align: center;">
        @if ($accion == 'guardar')Registrar @endif
        @if ($accion == 'editar')Actualizar @endif
        factura de compra</H1>

        <br>

        {{-- Numero de facturación --}}

        <div style="padding-left:0% ">
        <label class="col-md-2">Número de factura</label>
        <input  {{ $accion == 'guardar' ? '' : 'disabled' }} onkeyup="cargarNumeroFactura()" type="text"  style="display:flex padding-right:50%" name="Numero_factura" id="Numero_factura"  aria-label="Sizing example input" onkeypress="ValidaSoloNumeros4()"
         aria-describedby="inputGroup-sizing-sm" class="input ancho" required placeholder="Ingrese el número de factura"
         title="Solo debe contener números" value="{{old('Numero_factura')}}" minlength="11" maxlength="11" >
        </div>

        <br>

        {{-- Fecha de facturación --}}
        <div style="padding-left: 5%  display: flex">
        <label  class="col-md-2" >Fecha de facturación</label>
        <input {{ $accion == 'guardar' ? '' : 'disabled' }} type="date" style="display:flex padding-right:50%"
        name="Fecha_facturacion" id="Fecha_facturacion"
        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  class="input1 ancho"
        required  placeholder="Fecha de facturacion" value="{{old('Fecha_facturacion')}}">
        </div>
        <br>



        {{-- proveedores--}}
    <div   style="display: flex">
         <label class="col-md-2" for="Proveedores" >Proveedor</label>
        <select class="form-control select" style=" width:30%" {{ $accion == 'guardar' ? '' : 'disabled' }}  name="Proveedor" id="Proveedor"
          class="buscador-select" style="display:flex">
          <option  value="" required [readonly]='true'>Seleccione o busque el proveedor</option>
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
        {{-- <button hidden type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="openoriginalmodal"></button> --}}
        </div>
        <br>
        <br>

        <table class="table table-hover"  >
            <thead>
                <h5 style="display:none" id="leyenda">Agregue datos a la factura</h5>
                <tr>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                    <th>Precio de compra</th>
                    <th>Precio de venta</th>
                    <th>Impuesto</th>
                    <th>Total Producto</th>

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
                <button  onclick="actualizarFactura()"  class="btn btn-outline-dark"  type="button" >
                <a class="a"  href="{{route('compra.index')}}">
                <i class="bi bi-folder-fill"> Actualizar</i></a>
                </button>
                <button class="btn btn-outline-dark"  type="button" >
                    <a class="a"  href="{{route('compra.index')}}"><i class="bi bi-x-circle"> Cerrar </i></a>
                </button>
                @endif
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

                <button class="btn btn-outline-dark" onclick="openmodalproduct()" type="button"> <i class="bi bi-bag-plus"></i>Agregar producto</button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </label>
                </div>
            <div class="modal-body" >

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
                        <input type="text" value="" id="Cantidad" style=" width:54.5%" name="Cantidad" onkeypress="ValidaSoloNumeros()"
                        minlength="1" maxlength="4">
                        </div>

                        <!--  Precio compra -->

                            <div class="col" style="padding-right: 1.5%"  >
                            <label for="" class="group-text" style="padding-right: 1.5%" >Precio compra</label>
                            <input type="text" value="" id="Costo" style=" width:55.5%"  name="Costo" onkeypress="ValidaSoloNumeros1()"
                            minlength="1" maxlength="5">
                            </div>
                        </div>

                        <!-- Precio Venta -->
                        <div class="input-group input-group-sm mb-1" style="padding-left:1.6%"  style="width: 150%" ><br>
                        <div class="col" style="padding-left: 1.5%" >
                        <label for="" class="group-text" style="padding-right: 8.5%" >Precio venta</label>
                        <input type="text" value="" id="Precio_venta" style=" width:51%" name="Precio_venta" onkeypress="ValidaSoloNumeros2()"
                        minlength="1" maxlength="5">
                        </div>

                        <!-- Impuesto -->
                        <div class="col"style="padding-right:31%"   >
                        <label for="" class="group-text" style="padding-right:12.5%" >Impuesto</label>
                        <input type="text" value="" id="Impuesto" style=" width:51%" name="Impuesto" onkeypress="ValidaSoloNumeros3()"
                        minlength="1" maxlength="2">
                        </div>
                        </div>


                        <input type="text" hidden  value="" name="Numero_facturaform" id="Numero_facturaform" >
                        <input type="text" hidden  value="" name="id_product" id="id_product" >
                        <input type="text" hidden  value="" name="id_prov" id="id_prov" >
                        <input type="text" hidden  value="" name="id_detalle" id="id_detalle" >
                        <input type="text" hidden  value="" name="id_cat" id="id_cat" >

                    </form>
                </div>

                <!-- Botones -->
                <div class="modal-footer" style="text-align: center">
                <button  type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"  href="{{route('compra.index')}}" ><i class="bi bi-x-circle"> Cerrar</i></button>
                <button id="AgregarDF" type="button" class="btn btn-outline-dark" style="display:block" onclick="AgregarDetalle()" ><i class="bi bi-bag-plus"> Agregar</i></button>
                <button id="AgregarDFC" type="button" class="btn btn-outline-dark" style="display:block" onclick="AgregarDetalle()"  data-bs-dismiss="modal"> <i class="bi bi-bag-x">Agregar y cerrar</i></button>
                <button id="ActualizarDF" type="button" class="btn btn-outline-dark" style="display:none" onclick="ActualizarDetalle()" ><i class="bi bi-bag-plus"> Actualizar</i></button>
                <button id="ActualizarDFC" type="button" class="btn btn-outline-dark" style="display:none" onclick="ActualizarDetalle()"  data-bs-dismiss="modal"> <i class="bi bi-bag-x"> Actualizar y cerrar</i></button>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal de dialogo de agregar producto -->
        <div class="modal fade"  id="modalagregarproductos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-xl" >
            <div class="modal-content">
                <div class="modal-header">
                    Agregar Productos
                </div>
                <div class="modal-body" >
                    <div style="display: flex">
                        <input type="text" minlength="3" maxlength="25"  id="Nombre_producto_form" pattern="[A-ZÑ a-zñ0-9]+"
                        class="form-control"  required placeholder="Nombre del producto"> &nbsp;

                        <input type="text" minlength="1" maxlength="25" id="Marca_form" pattern="[A-ZÑ a-zñ]+"  class="form-control" required
                        placeholder="Marca del producto" > &nbsp;

                        <textarea class="form-control" rows="1" pattern="[A-ZÑ a-zñ][0-9]+"
                        minlength="5" maxlength="50" id="Descripcion_form" placeholder="Ingrese la descripción del producto" required></textarea>
                    </div>


                        <div style="display: flex;margin-top:1rem">
                              {{-- proveedores--}}
                              {{-- <input type="text" disabled  id="Proveedor_form" class="form-control" > --}}

                            <select disabled class="form-control" id="Proveedor_form">
                                @foreach ($proveedores as $p)
                                <option  value="{{$p->id}}" >{{$p->Nombre_empresa}}</option>
                                @endforeach
                            </select>

                            &nbsp;

                            <select id="categoria_form" class="form-control">
                                <option value="" selected disabled>Seleccione una categoria</option>
                                @foreach ($categorias as $cat)
                                    <option value="{{$cat->id}}">{{$cat->Descripcion}}</option>
                                @endforeach
                            </select>
                        </div>

                </div>

                <!-- Botones -->
                <div class="modal-footer" style="text-align: center">
                <button  type="button" class="btn btn-outline-dark" onclick="cerrarmodalproductos()"><i class="bi bi-x-circle"> Volver</i></button>
                <button type="button" class="btn btn-outline-dark" style="display:block" onclick="guardarProductoaBASE()" ><i class="bi bi-bag-plus"> Agregar</i></button>
                    </div>
            </div>
            </div>
        </div>


<script>

    // declaramos los dos modales para acceder a ellos con los metodos de javascript
    var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
    var myModalProd = new bootstrap.Modal(document.getElementById('modalagregarproductos'));



        // TODO LO QUENO ESTA EN UNA FUNCION, SE EJECUTA CUANDO SE INICIA LA VISTA

        //siempre colocar para el select search en cada componente
        $(document).ready(function() {
            $('.buscador-select').select2();
        });

        // varibles publicas, a las que pueden acceder todas las funciones

        //pasando las variables php, a javascript
        var detallefactura = {!! json_encode($detallefactura, JSON_HEX_TAG) !!};
        var factura = {!! json_encode($factura, JSON_HEX_TAG) !!};
        var products = {!! json_encode($products, JSON_HEX_TAG) !!};
        var accion = {!! json_encode($accion, JSON_HEX_TAG) !!};


        var productfiltersProveedor;
        var totalFACTURA;

        document.getElementById("Numero_factura").value = factura.Numero_factura ;
        document.getElementById("Fecha_facturacion").value = factura.Fecha_facturacion;
        totalFACTURA= factura.Total_factura;
        document.getElementById("Proveedor").value = factura.Proveedor;

        dibujarTabla(detallefactura);






        // INICIO DE LAS FUNCIONES

        function openmodalproduct(){
        myModal.hide();
        myModalProd.show();
        document.getElementById("Proveedor_form").value = document.getElementById("Proveedor").value
        }

        function cerrarmodalproductos(){
            myModalProd.hide();
            myModal.show();
            limpiarformbase();
        }
        
        function guardarProductoaBASE() {
            // inputs del form
            var nombre = document.getElementById('Nombre_producto_form').value
            var marca = document.getElementById('Marca_form').value
            var descripcion = document.getElementById('Descripcion_form').value
            var proveedor = document.getElementById('Proveedor').value
            var categoria = document.getElementById('categoria_form').value

            var re = /^[a-zA-Z0-9 ]+$/;
            if(nombre == ""){

                alertify.error("El nombre del producto es requerido")
                return;


            }else if (!re.test(nombre)) {
                alertify.error('No se aceptan signos especiales')
                return;

            }else if(nombre.length > 25){
                alertify.error('El maximo es de 25 caracteres')
                return;
            }else if(nombre.length < 3){
                alertify.error('El minimo es de 3 caracteres')
                return;
            }

            if(marca == ""){
              alertify.error("La marca del producto es requerida")
                return;
            }

            else if (!re.test(marca)) {
                alertify.error('No se aceptan signos especiales')
                return;

            }
             else if(marca.length > 25){
                alertify.error('El maximo es de 25 caracteres')
                return;
             }
             else if(marca.length < 2){
                alertify.error('El minimo es de 2 letras')
                return;
            }
            if(descripcion == ""){
              alertify.error("La descripción del producto es requerida")
                return;

            }
            else if (!re.test(descripcion)) {
                alertify.error('No se aceptan signos especiales')
                return;

            }
            else if(descripcion.length > 25){
                alertify.error('El maximo es de 25 caracteres')
                return;
             }
             else if(descripcion.length < 3){
                alertify.error('El minimo es de 3 caracteres')
                return;
            }
            //hacer los otros dos campos

            if(proveedor == '0'){
                alertify.error('Seleccione un proveedor')
                return;
            }

            if(categoria == '0'){
                alertify.error('Seleccione una categoria')
                return;
            }

            datosaguardar = {
                "nombre":nombre,
                "marca":marca,
                "descripcion":descripcion,
                "proveedor":proveedor,
                "categoria":categoria
            }
            $.ajax({
                    type: "POST",
                    url: '/guardarProductoModal',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "data":datosaguardar
                    },
                    success: function(data) {
                        // actualizamos la variable con el nuevo producto
                        products = data
                        var proveedor = document.getElementById('Proveedor').value;
                        productfiltersProveedor =  products.filter((x) => x.id_prov == proveedor);
                        buscarydibujarProductos();
                        alertify.success("Producto guardado");
                        cerrarmodalproductos();
                    }
                })

        }
        function limpiarformbase(){
            document.getElementById("Nombre_producto_form").value = '';
            document.getElementById("Marca_form").value ='';
            document.getElementById("Descripcion_form").value = '';
            document.getElementById("categoria_form").value ='';

        }

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

                   //armamos el json con los campos de ls DB
            var jsonFactura = {
                Numero_factura : document.getElementById("Numero_factura").value,
                Fecha_facturacion : document.getElementById("Fecha_facturacion").value,
                Proveedor : document.getElementById("Proveedor").value,
                Total_factura : totalFACTURA
            };

            swal.fire({
                title: '¿Está seguro que desea guardar los datos?',
                icon: 'question',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            },
            function(){
            }).then((result)=>{
                if (result.isConfirmed) {
                    //pasamos lo el json, y el arreglo de detalles, a string para que se manden como parametros por la ruta
                    var stringarrayFactura = JSON.stringify(jsonFactura);
                var stringarrayDetalles = JSON.stringify(detallefactura);
                window.location.href = `{{URL::to('/guardarFactura/`+stringarrayFactura+`/`+stringarrayDetalles+`')}}`;

                }
            })
            event.preventDefault()
            
        }


   

        function actualizarFactura() {
            //armamos el json con los campos de ls DB, ahora con el id de la base de datos que se hizo
            var data = {
                Total_factura : totalFACTURA,
                id:factura.id
            };

            $.ajax({
                    type: "POST",
                    url: '/actualizarFactura',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "data":data
                    },
                    success: function() {
                        console.log("detalle guardado");
                    }
                })


        }

        function openmodal(){
            var factura = document.getElementById('Numero_factura').value;
            var proveedor = document.getElementById('Proveedor').value;

            if(factura != '' && factura != undefined && factura != null){
                if (factura.length != 11) {
                    alertify.error("El numero de la factura debe tener 11 caracteres");
                    return;
                }
                if(proveedor != '' && proveedor != undefined && proveedor != null){
                    productfiltersProveedor =  products.filter((x) => x.id_prov == proveedor);

                    buscarydibujarProductos();
                    cargarNumeroFactura();
                    // para abrir el modal detalles
                    myModal.show();


                    limpiarform();

                    //oculta y muestra los botones de accion del modal, (Agregar/ Actualizar
                    document.getElementById("AgregarDF").style.display = 'block';
                    document.getElementById("AgregarDFC").style.display = 'block';
                    document.getElementById("ActualizarDF").style.display = 'none';
                    document.getElementById("ActualizarDFC").style.display = 'none';

                }else{
                    alertify.error('Ingrese Proveedor')
                    return;
                }

            }else{
                alertify.error('Ingrese Factura')
                return;
            }
        }

        function buscarydibujarProductos(){
            var  inputBuscarProveedor = document.getElementById('inputBuscarProveedor').value;

            // filtrando los productos por proveeddor
            productfiltersBuscador = productfiltersProveedor.filter((x) => x.Nombre_producto.toLowerCase().includes(inputBuscarProveedor.toLowerCase()));

            // haciendo la tabla con los productos filtrados anteriormente
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
            //con el inner html, inyectamos la tabla en el div con este id, en el modal
            document.getElementById("buscar_producto_proveedor").innerHTML = html;
        }

        function cargarNumeroFactura() {
        var numfactura = document.getElementById("Numero_factura").value;
        //se manda al input ihidden del formulario
        document.getElementById("Numero_facturaform").value = numfactura;
        // se manda al titulo del modal
        document.getElementById("numfact_form").innerHTML = '<span>'+numfactura+'</span>';
        }

        function cargarProducto(select) {

            if (select == '') {
                limpiarform();
            }else{
                // buscar el producto por el value del input,(id_producto)
                pro = products.filter((x)=> x.id_product == select)

                //asignamos los valores a las cajas del modal, y alas las hidden tambien
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

                //mostramos y escondemos los botones que necesitan
                document.getElementById("AgregarDF").style.display = 'block';
                document.getElementById("AgregarDFC").style.display = 'block';
                document.getElementById("ActualizarDF").style.display = 'none';
                document.getElementById("ActualizarDFC").style.display = 'none';
            }
        }

        function  AgregarDetalle(){
           var nombre_producto =  document.getElementById("nombre_producto").value;
           var Marca =  document.getElementById("Marca").value;
           var Descripcion =  document.getElementById("Descripcion").value;
           var Categoria =  document.getElementById("Categoria").value;
           var Cantidad = document.getElementById("Cantidad").value;
           var Costo = document.getElementById("Costo").value;
           var Precio_venta = document.getElementById("Precio_venta").value;


           if(nombre_producto == ''){
            alertify.error("Seleccionar producto");
            return;
           }

           if(Marca == ''){
            alertify.error("Seleccionar producto");
            return;
           }

           if(Descripcion == ''){
            alertify.error("Seleccionar producto");
            return;
           }
           if(Categoria == ''){
            alertify.error("Seleccionar producto");
            return;
           }

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

           if( parseFloat(Precio_venta) < parseFloat(Costo)){
            alertify.error("El precio de venta no debe ser menor al precio de compra");
            return;
           }else if(parseFloat(Precio_venta) == parseFloat(Costo)){
            alertify.error("El precio de venta no debe ser igual al precio de compra");
            return;
           }



            //    armamos el json de los stringarrayDetalles
            //    con un uuid, para poder actualizarlo, incluso cuando aun no se ha guardado
            //    para eso utilizamos la funcion uuidv4
            var jsonproducto = {
                "id_detalle":uuidv4(),
                "id_product":  document.getElementById("id_product").value,
                "id_prov":  document.getElementById("id_prov").value,
                "id_cat":  document.getElementById("id_cat").value,
                "Numero_facturaform":  document.getElementById("Numero_facturaform").value,
                "nombre_producto": nombre_producto,
                "Marca":  Marca ,
                "Descripcion": Descripcion,
                "Categoria": Categoria,
                "Cantidad": Cantidad,
                "Costo": Costo,
                "Precio_venta": Precio_venta,
                "Impuesto": document.getElementById("Impuesto").value,
            };

            var existe = 0;
            var iddetalleactualizar = "";
            var nuevacantidad = 0;
            detallefactura.forEach(element => {
                if(element.id_product == jsonproducto.id_product && element.Impuesto == jsonproducto.Impuesto ){
                    existe ++;
                    iddetalleactualizar = element.id_detalle
                    nuevacantidad =  (parseFloat(element.Cantidad) + parseFloat(jsonproducto.Cantidad));
                    element.Cantidad = nuevacantidad
                    element.Costo =jsonproducto.Costo ;
                    element.Precio_venta =jsonproducto.Precio_venta;
                }
            });

            if (existe == 0) {
                if(accion == 'editar'){
                    $.ajax({
                        type: "POST",
                        url: '/agregardetallepro',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "data":jsonproducto
                        },
                        success: function(data) {
                            console.log(data);
                        }
                    })
                }
                detallefactura.push(jsonproducto);
            }else{
                if(accion == 'editar'){
                    let editdetpro = {
                        "id":iddetalleactualizar,
                        "Cantidad":nuevacantidad,
                        "Costo":jsonproducto.Costo,
                        "Precio_venta":jsonproducto.Precio_venta,
                        "Impuesto":jsonproducto.Impuesto
                    }

                    $.ajax({
                        type: "POST",
                        url: '/editardetallepro',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "data":editdetpro
                        },
                        success: function() {
                            console.log("Valueadded");
                        }
                    })
                }
            }




            dibujarTabla(detallefactura);
            limpiarform()
        }

        function dibujarTabla(data){
            var html = '';
            var htmlagregados = '';

            htmlagregados +='<div style="text-align:center "><strong>Productos agregados</strong></div>';

            htmlagregados +='<div>';
            htmlagregados +='<div class="row" style="font-weight:bold">';
            htmlagregados +='<div class="col">Nombre </div>';
            htmlagregados +='<div class="col">Marca </div>';
            htmlagregados +='<div class="col">Cantidad </div>';
            htmlagregados +='<div class="col">Editar</div>';
            htmlagregados +='<div class="col">Eliminar</div>';
            htmlagregados +='</div>';
            htmlagregados +='</div>';


            htmlagregados +='<div  style="height:10rem;overflow:auto">';

            subtotalFACTURA = 0;
            totalFACTURA = 0;
            totalInmpuesto = 0;


           //TABLA GRANDE AFUERA
            data.forEach(element => {

                totalproducto = ( element.Cantidad * element.Costo)
                totalInmpuesto += (( element.Cantidad * element.Costo) * (element.Impuesto/100))
                html += '<div class= "box">';
                html += '<tr>';
                html += '<td>'+element.nombre_producto+'</td>';
                html += '<td>'+element.Marca+'</td>';
                html += '<td>'+element.Categoria+'</td>';
                html += '<td>'+element.Cantidad+'</td>';
                html += '<td>Lps. '+element.Costo+'</td>';
                html += '<td>Lps. '+element.Precio_venta+'</td>';
                html += '<td>'+element.Impuesto+'%</td>';
                html += '<td>Lps. '+totalproducto.toFixed()+'</td>';
                //html += '<td><button class="btn btn-outline-dark">Eliminar</button></td>';
                html += '</tr>';
                html += '</div';

                htmlagregados +='<table class="table table-hover">';
                htmlagregados +='<div  class="row">';
                htmlagregados += '<div class="col">'+element.nombre_producto+'</div>';
                htmlagregados += '<div class="col">'+element.Marca+'</div>';
                htmlagregados += '<div class="col">'+element.Cantidad+'</div>';
                htmlagregados += `<div class="col" style="display:flex">`+
                    `<button class="btn btn-outline-dark" onclick="editardetalle('`+element.id_detalle+`')"><i class="bi bi-pen-fill"></i></button>`;
                htmlagregados +='</div>';
                htmlagregados += `<div class="col" style="display:flex">`+
                    `<button class="btn btn-outline-dark" onclick="eliminardetalle('`+element.id_detalle+`')"><i class="bi bi-trash"></i></button>`;


                htmlagregados +='</div>';
                htmlagregados +='</table>';

                subtotalFACTURA += totalproducto;
            });

            htmlagregados +='</div>';


                html += '<tr>';
                html += '<td></td> <td></td> <td></td> <td></td> <td></td> <td></td>';
                html += '<td><strong >SubTotal</strong></td>';
                html += '<td><strong>Lps. '+subtotalFACTURA.toFixed()+'</strong></td><td></td>';
                html += '<tr>';

                html += '<tr>';
                html += '<td></td> <td></td> <td></td> <td></td> <td></td> <td></td>';
                html += '<td><strong >Impuesto</strong></td>';
                html += '<td><strong>Lps. '+totalInmpuesto.toFixed()+'</strong></td><td></td>';
                html += '<tr>';

                    totalFACTURA =  (parseFloat(subtotalFACTURA) + parseFloat(totalInmpuesto));
                html += '<tr>';
                html += '<td></td> <td></td> <td></td> <td></td> <td></td> <td></td>';
                html += '<td><strong >Total factura</strong></td>';
                html += '<td><strong>Lps. '+totalFACTURA.toFixed() +'</strong></td><td></td>';
                html += '<tr>';

            //inyectando los dos variables a donde correspondan
            document.getElementById('body_table_detallesFac').innerHTML = html;
            document.getElementById('body_table_detallesFacModal').innerHTML = htmlagregados;

        }

        function eliminardetalle(id_detalle){
            swal.fire({
                title: '¿Desea eliminar este detalle?',
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
                    detallefactura = detallefactura.filter((x) => x.id_detalle != id_detalle)

                    //eliminar de la base de datos, solo si estamos en editar
                    if(accion == 'editar'){
                        $.ajax({
                            type: "POST",
                            url: '/eliminardetallepro',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "data":id_detalle
                            },
                            success: function() {
                                
                            }
                        })
                    }
                    alertify.success('Eliminado correctamemte')
                }
                 // volver a dibujar la tabla para que se note la diferencia
                dibujarTabla(detallefactura);
               
            })
            event.preventDefault()
        }
       


   



        function editardetalle(id_detalle){

            //buscamos el registro por el id
            var detalleaeditar = detallefactura.filter((x) => x.id_detalle == id_detalle)

           var Costo = document.getElementById("Costo").value;
           var Precio_venta = document.getElementById("Precio_venta").value;

            //con ese registro filtrado, cargamos las cajas del modal
            // incluyendo el id del detalles, que esta en la base de datos
            document.getElementById("id_detalle").value = detalleaeditar[0].id_detalle;
            document.getElementById("id_product").value = detalleaeditar[0].id_product;
            document.getElementById("id_prov").value = detalleaeditar[0].id_prov;
            document.getElementById("id_cat").value = detalleaeditar[0].id_cat;
            document.getElementById("nombre_producto").value = detalleaeditar[0].nombre_producto;
            document.getElementById("Marca").value = detalleaeditar[0].Marca;
            document.getElementById("Descripcion").value = detalleaeditar[0].Descripcion;
            document.getElementById("Categoria").value = detalleaeditar[0].Categoria;
            document.getElementById("Cantidad").value = detalleaeditar[0].Cantidad;
            document.getElementById("Costo").value = detalleaeditar[0].Costo;
            document.getElementById("Precio_venta").value = detalleaeditar[0].Precio_venta;
            document.getElementById("Impuesto").value = detalleaeditar[0].Impuesto;




            // cambiamos los botones a actualizar
            document.getElementById("AgregarDF").style.display = 'none';
            document.getElementById("AgregarDFC").style.display = 'none';
            document.getElementById("ActualizarDF").style.display = 'block';
            document.getElementById("ActualizarDFC").style.display = 'block';

            if( parseFloat(Precio_venta) < parseFloat(Costo)){
            alertify.error("El precio de venta no debe ser menor al precio de compra");
            return;
           }else if(parseFloat(Precio_venta) == parseFloat(Costo)){
            alertify.error("El precio de venta no debe ser igual al precio de compra");
            return; }

        }

         function ActualizarDetalle(){
            //copiamos las mismas validacion de agregar
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


            if( parseFloat(Precio_venta) < parseFloat(Costo)){
            alertify.error("El precio de venta no debe ser menor al precio de compra");
            return;
           }else if(parseFloat(Precio_venta) == parseFloat(Costo)){
            alertify.error("El precio de venta no debe ser igual al precio de compra");
            return;
           }

           //obtener el id del detalle que vamos a actualizar, con los valores de las cajas
           var iddetalleinput = document.getElementById("id_detalle").value;
           //recooremos la varible global del la vista,(detallefactura)

           let editdetpro = {
            "id":iddetalleinput,
            "Cantidad":Cantidad,
            "Costo":Costo,
            "Precio_venta":Precio_venta,
            "Impuesto":document.getElementById("Impuesto").value,
           }


           $.ajax({
                type: "POST",
                url: '/editardetallepro',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "data":editdetpro
                },
                success: function() {
                    console.log("Valueadded");
                }
            })


           detallefactura.forEach(element => {
            // y donde coincida, darle los mismos valores de la cajas al elemento
            if(element.id_detalle == iddetalleinput){
                element.Cantidad = Cantidad;
                element.Costo = Costo;
                element.Precio_venta = Precio_venta;
                element.Impuesto =  document.getElementById("Impuesto").value;
            }
           });

           //dibujamosla tabla para que se mire el campo, y regresamos los botones, y limpiamos los campos
            dibujarTabla(detallefactura);
            limpiarform()
            document.getElementById("AgregarDF").style.display = 'block';
            document.getElementById("AgregarDFC").style.display = 'block';
            document.getElementById("ActualizarDF").style.display = 'none';
            document.getElementById("ActualizarDFC").style.display = 'none';
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

        function uuidv4() {
            return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
                (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
            );
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
{{-- <script>
    function guardarcompra() {
       var formul = document.getElementById("form_guardarCompra");

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
</script> --}}
@endpush
    @include('common')
