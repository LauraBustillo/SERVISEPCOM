@extends('main')
@section('extra-content')

<style>
    /*Los titulos */
    .titulo {
        font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
        color: #000000;
        font-family: 'Open Sans';
        font-size: 20xp;
    }

    /*Cajas de texto*/
    .form-control {
        background-color: transparent;
        border: 1.3px solid #000000;
        height: fit-content;

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
    .input-group-text {
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

    .btn-outline-dark:hover {
        background-color: rgb(48, 48, 48);
        color: white;
    }

    a {
        color: aliceblue;
        outline: none;
        text-decoration: none;
        color: #000000;
    }

    .a:hover {
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
        color: black;
        font-family: 'Open Sans';
        font-size: 20px;
    }

    .titulo1 {
        font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
        color: black;
        font-family: 'Open Sans';
        font-size: 40px;
        text-align: center;
    }
    /*Letras del modal*/
    .group-texto {
    background-color: transparent;
    font-family: 'Open Sans';
    color: #000000;
    font-size: 25px;
    }
    .letra {
        font-weight: bold;
    }

    .input {
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

    .modal-body {
        background-color: rgb(142, 220, 243) !important;
    }

    .modal-header {
        background-color: rgb(184, 234, 249) !important;
    }

    .modal-content {
        background-color: rgb(184, 234, 249) !important;
    }


    div.container {

width: 100% !important;
height: 100% !important;
padding-left: 10% !important;
}
</style>




<form class="form-control">
    @csrf
    {{-- titiulo --}}
    <div style="display: flex">
        <h1 class="titulo1 mx-auto">Registro de venta</h1>
    </div>

    <input name='id_rango' id='id_rango' type="text" hidden value="{{ $rangoActual[0]->id??'' }}">



    <div>
        <div style="display: flex">
            <div style="width: 100%">

                <b><label>Número de Factura</label></b>
                <input name='numeroFactura' id='numeroFactura' readonly class="form-control" placeholder="No hay rango registrado" maxlength="5" minlength="1" value={{ $num_factura }}>
            </div> &nbsp;&nbsp;
            <div style="width: 100%">
                <b><label>Empleado</label></b>
                <input name='empleadoVentas' id='empleadoVentas' class="form-control" maxlength="30" minlength="1" required>
            </div> &nbsp;&nbsp;
        </div>

        <div style="display: flex">
            <div style="width: 100%">
                <b><label>Fecha de facturación</label></b>
                <input name='fechaFactura' id='fechaFactura' readonly type="date" class="form-control" placeholder="" maxlength="5" minlength="1" value={{ $fecha_actual }}>
            </div> &nbsp;&nbsp;
            <div style="width: 100%">
                <b><label>Cliente</label></b>
                <!-- Dar la opcion de selecciona un dato por defecto consumidor final-->
                <select class="form-control select buscador-select" name='clienteFactura' id='clienteFactura' >
                    <option value="" required [readonly]='true'>Seleccione o busque un cliente</option>
                    @foreach ($clientes as $cliente)
                    <option>{{ $cliente->Nombre.' '.$cliente->Apellido }}</option>
                    @endforeach
                </select>
            </div> &nbsp;&nbsp;
        </div>
    </div>
    <br>
    <div class="form-check form-switch">
        <label>Garantia</label>
        <input style="display:flex;" class="form-check-input" type="checkbox" id="switchGarantia" name="switchGarantia" >
    </div>
    <br>
    <div>
        <button onclick="openmodal()" class="btn btn-outline-dark" type="button">
            <i class="bi bi-file-text-fill"> Agregar Detalle </i>
        </button>

        @if(count($rangoActual) == 1)
        @php
        /*
        Compara la fecha de vencimiento y la fecha de hoy para evitar que el usuario
        agregue un rango nuevo sin haber terminado el anterior
        */
        date_default_timezone_set("America/Tegucigalpa");
        $diferencia = strtotime($rangoActual[0]->fechaVencimiento) - strtotime("now");
        $dias = floor($diferencia / (60 * 60 * 24)) + 1;
        @endphp
        @if($dias < 0) <a class="btn btn-outline-dark" onclick="abrirmodalrangos()">Agregar nuevo rango</a>
            @endif
            @else
            <a class="btn btn-outline-dark" onclick="abrirmodalrangos()"><i class="bi bi-calendar-range"> Agregar nuevo rango</i></a>
            @endif

            {{-- Boton de el modal--}}

    </div>
    <br>
    <div style="display: flex">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>

                    <th>Precio de venta</th>
                    <th>Impuesto</th>
                    <th>Total Producto</th>

                </tr>
            </thead>
            <tbody id="body_table_detallesFac">

            </tbody>
        </table>
    </div>
    <br>
    <center>
        <button class="btn btn-outline-dark" type="button" onclick="guardatFactura()">
            <i class="bi bi-receipt-cutoff"> Facturar</i>
        </button>
        <button class="btn btn-outline-dark" type="button">
            <a class="a" href="{{ route('Venta.index') }}"><i class="bi bi-x-circle"> Cerrar </i></a> {{-- Falta la ruta
            de cerrar y regresar al listado --}}
        </button>
    </center>

</form>





<!-- Modal de rangos -->


<div class="modal fade" id="modalverrango" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="titulo1">
                    Habilitar rangos de factura
                </h3>
            </div>
            <div class="modal-body">
                <form class="form-control" method="POST" action="{{ route('store.registroRang') }}">

                    @csrf

                    <div style="display: flex">

                        <div style="width: 30%" class="mx-auto">
                            <h6 class="mx-auto letra titulo">Facturación electrónica de venta</h6>
                        </div>
                    </div>
                    <br>
                    <center>
                        <div style="display: flex">
                            <div style="width: 50%" class="mx-auto">
                                <label>Número CAI</label>
                                <input id="numero_cai" name="numero_cai" type="text" class="form-control" placeholder="Ej.000000-000000-000000-000000-000000-00" maxlength="37">
                            </div>
                        </div>
                    </center>
                    <center>
                        <div style="display: flex">
                            <div style="width: 30%" class="mx-auto">
                                <label>Rango desde</label>
                                <input id="rango_desde" name="rango_desde" type="text" class="form-control" placeholder="Ej.000-000-00-00000000" maxlength="19">
                            </div> &nbsp;&nbsp;
                            <div style="width: 30%" class="mx-auto">
                                <label>Rango hasta</label>
                                <input id="rango_hasta" name="rango_hasta" type="text" class="form-control" placeholder="Ej.000-000-00-00000000" maxlength="19">
                            </div>
                        </div>
                    </center>
                    <center>
                        <div style="display: flex">
                            <div style="width: 30%" class="mx-auto">
                                <label>Fecha desde</label>
                                <input id="fecha_desde" name="fecha_desde" type="date" class="form-control" placeholder="" value="{{ Carbon\Carbon::now()->timezone('America/Tegucigalpa')->format('Y-m-d') }}">
                            </div> &nbsp;&nbsp;
                            <div style="width: 30%" class="mx-auto">
                                <label>Fecha hasta</label>
                                <input id="fecha_hasta" name="fecha_hasta" type="date" class="form-control" placeholder="">
                            </div>
                        </div>
                    </center>
                    <br>
                    <br>
                    <div style="display: flex">
                        <div style="display: flex" class="mx-auto">
                            <button type="submit" class="btn btn-outline-dark"><i class="bi bi-plus-square">
                                    Agregar</i></button> &nbsp;
                            <a class="btn btn-outline-dark"><i class="bi bi-eraser-fill"> Limpiar </i> </a>

                        </div>

                    </div>
                    <br>
                </form>
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-outline-dark" onclick="cerrarmodalrango()"><i class="bi bi-x-circle"> Cerrar</i></button>
            </div>
        </div>
    </div>
</div>



<!-- Modal de dialogo de agregar producto -->
<div class="modal fade" id="agregard" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="group-texto" id="staticBackdropLabel" style="text-align: center">
                    Agregar producto a la factura # <span id="numfact_form"></span>
                </h1>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <input type="text" id="inputBuscarProveedor" onkeyup="buscarydibujarProductos()" value="" class="form-control me-2" placeholder="Buscar por nombre del producto">
                    </div>
                    <div class="col"></div>
                </div>

                <br>
                <div class="row">
                    <div class="col">
                        {{-- tabla de buscar producto --}}
                        <div id="buscar_producto_proveedor" class="table-responsive" style="height: 14rem;">
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
                <form action="">


                    <div style="display: flex">
                        <!-- Nombre producto -->
                        <div style="width: 20%">
                            <label for="" class="group-text">Nombre producto</label>
                            <input disabled type="text" value="" id="nombre_producto" name="nombre_producto">
                        </div>
                        <!-- Marca producto -->
                        <div style="width: 20%">
                            <label for="" class="group-text">Marca producto</label>
                            <input disabled type="text" value="" id="Marca" name="Marca">
                        </div>
                        <!-- Cantidad -->
                        <div style="width: 20%">
                            <label for="" class="group-text">Cantidad</label>
                            <input type="text" value="" id="Cantidad" name="Cantidad" onkeypress="ValidaSoloNumeros()" minlength="1" maxlength="4">
                        </div>
                    </div>



                    <div style="display: flex">

                        <div style="width: 20%">
                            <!-- Precio Venta -->
                            <label for="" class="group-text">Precio venta</label>
                            <input type="text" value="" disabled id="Precio_venta" name="Precio_venta" onkeypress="ValidaSoloNumeros2()" minlength="1" maxlength="5">
                        </div>

                        <div style="width: 20%">
                            <!-- Impuesto -->
                            <label for="" class="group-text">Impuesto</label>
                            <input type="text" value="" id="Impuesto" name="Impuesto" onkeypress="ValidaSoloNumeros3()" minlength="1" maxlength="2">
                        </div>

                         <!-- Descripcion -->
                        <div style="width: 20%">
                            <label for="" class="group-text">Descripción</label>
                            <input disabled type="text" value="" id="Descripcion" name="Descripcion">
                        </div>
                    </div>

                    <div style="display: flex">
                        <!--  Descuento -->
                        <div style="width: 20%">
                            <label for="" class="group-text"></label>
                            <input type="text" value="" hidden id="Costo" name="Costo" onkeypress="ValidaSoloNumeros1()" minlength="1" maxlength="5">
                        </div>
                    </div>






                    <input type="text" hidden value="" name="Numero_facturaform" id="Numero_facturaform">
                    <input type="text" hidden value="" name="Numero_cai" id="Numero_cai">

                    <input type="text" hidden value="" name="id_product" id="id_product">
                    <input type="text" hidden value="" name="id_prov" id="id_prov">
                    <input type="text" hidden value="" name="id_detalle" id="id_detalle">
                    <input type="text" hidden value="" name="id_cat" id="id_cat">
                    <input type="text" hidden value="" name="id_inventa" id="id_inventa">
                    <input type="text" hidden value="" name="CantidadExistencia" id="CantidadExistencia">

                </form>

            </div>


            <!-- Botones -->
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" href="{{route('compra.index')}}"><i class="bi bi-x-circle"> Cerrar</i></button>
                <button id="AgregarDF" type="button" class="btn btn-outline-dark" style="display:block" onclick="AgregarDetalle()"><i class="bi bi-bag-plus"> Agregar</i></button>
                <button id="AgregarDFC" type="button" class="btn btn-outline-dark" style="display:block" onclick="AgregarDetalle()" data-bs-dismiss="modal"> <i class="bi bi-bag-x">Agregar y
                        cerrar</i></button>
                <button id="ActualizarDF" type="button" class="btn btn-outline-dark" style="display:none" onclick="ActualizarDetalle()"><i class="bi bi-bag-plus"> Actualizar</i></button>
                <button id="ActualizarDFC" type="button" class="btn btn-outline-dark" style="display:none" onclick="ActualizarDetalle()" data-bs-dismiss="modal"> <i class="bi bi-bag-x"> Actualizar y
                        cerrar</i></button>
            </div>


        </div>

    </div>

</div>




<script>
    var detallefactura = {!! json_encode($detallefactura, JSON_HEX_TAG) !!};

    var myModalVerRangos = new bootstrap.Modal(document.getElementById('modalverrango'));
    var accion = @json($accion);

    // Abrir el modal para registrar los rangos(estaba como abrirmodalfotos)
    function abrirmodalrangos() {
        myModalVerRangos.show();
    }
    // Cerrar el modal para registrar los rangos
    function cerrarmodalrango() {
        myModalVerRangos.hide();
    }


    //Para abrir el modal de garegra detalle
    function openmodal() {
        var myModal = new bootstrap.Modal(document.getElementById('agregard'));
        // para abrir el modal detalles
        myModal.show();

        buscarydibujarProductos();
        cargarNumeroFactura();
        dibujarTabla(detallefactura);

    }

    function dibujarTabla(data) {
        var html = '';
        var htmlagregados = '';

        htmlagregados += '<div style="text-align:center "><strong>Productos agregados</strong></div>';

        htmlagregados += '<div>';
        htmlagregados += '<div class="row" style="font-weight:bold">';
        htmlagregados += '<div class="col">Nombre</div>';
        htmlagregados += '<div class="col">Marca</div>';
        htmlagregados += '<div class="col">Cantidad </div>';
        htmlagregados += '<div class="col">Editar</div>';
        htmlagregados += '<div class="col">Eliminar</div>';
        htmlagregados += '</div>';
        htmlagregados += '</div>';


        htmlagregados += '<div  style="height:10rem;overflow:auto">';

        subtotalFACTURA = 0;
        totalFACTURA = 0;
        totalInmpuesto = 0;


        //TABLA GRANDE AFUERA
        if(data.length > 0){


            data.forEach(element => {


                totalproducto = (element.Cantidad * element.Precio_venta)
                totalInmpuesto += ((element.Cantidad * element.Precio_venta) * (element.Impuesto / 100))
                html += '<div class= "box">';
                html += '<tr>';
                html += '<td>' + element.nombre_producto + '</td>';
                html += '<td>' + element.Marca + '</td>';
                html += '<td>' + element.Descripcion + '</td>';
                html += '<td>' + element.Cantidad + '</td>';
                //html += '<td>Lps. ' + element.Costo + '</td>';
                html += '<td>Lps. ' + element.Precio_venta + '</td>';
                html += '<td>' + element.Impuesto + '%</td>';
                html += '<td>Lps. ' + totalproducto.toFixed() + '</td>';
                //html += '<td><button class="btn btn-outline-dark">Eliminar</button></td>';
                html += '</tr>';
                html += '</div';

                htmlagregados += '<table class="table table-hover">';
                htmlagregados += '<div  class="row">';
                htmlagregados += '<div class="col">' + element.nombre_producto + '</div>';
                htmlagregados += '<div class="col">' + element.Marca + '</div>';
                htmlagregados += '<div class="col">' + element.Cantidad + '</div>';
                htmlagregados += `<div class="col" style="display:flex">` +
                    `<button class="btn btn-outline-dark" onclick="editardetalle('` + element.id_detalle + `')"><i class="bi bi-pen-fill"></i></button>`;
                htmlagregados += '</div>';
                htmlagregados += `<div class="col" style="display:flex">` +
                    `<button class="btn btn-outline-dark" onclick="eliminardetalle('` + element.id_detalle + `')"><i class="bi bi-trash"></i></button>`;


                htmlagregados += '</div>';
                htmlagregados += '</table>';

                subtotalFACTURA += totalproducto;

            });

        }

        htmlagregados += '</div>';


        html += '<tr>';
        html += '<td></td> <td></td> <td></td> <td></td> <td></td> ';
        html += '<td><strong >SubTotal</strong></td>';
        html += '<td><strong>Lps. ' + subtotalFACTURA.toFixed() + '</strong></td>';
        html += '<tr>';

        html += '<tr>';
        html += '<td></td> <td></td> <td></td> <td></td> <td></td> ';
        html += '<td><strong >Impuesto</strong></td>';
        html += '<td><strong>Lps. ' + totalInmpuesto.toFixed() + '</strong></td>';
        html += '<tr>';

        totalFACTURA = (parseFloat(subtotalFACTURA) + parseFloat(totalInmpuesto));
        html += '<tr>';
        html += '<td></td> <td></td> <td></td> <td></td> <td></td> ';
        html += '<td><strong >Total factura</strong></td>';
        html += '<td><strong>Lps. ' + totalFACTURA.toFixed() + '</strong></td>';
        html += '<tr>';

        //inyectando los dos variables a donde correspondan
        document.getElementById('body_table_detallesFac').innerHTML = html;
        document.getElementById('body_table_detallesFacModal').innerHTML = htmlagregados;

    }



    // Dibujar los productos en la tabla
    function buscarydibujarProductos() {
        var inputBuscarProveedor = document.getElementById('inputBuscarProveedor').value;

        // filtrando los productos por proveeddor
        productfiltersBuscador = @json($products).filter((x) => (x.Nombre_producto + ' ' + x.Marca).toLowerCase().includes(inputBuscarProveedor.toLowerCase()));

        // haciendo la tabla con los productos filtrados anteriormente
        html = '<table class="table table-hover" style="width: 100%";>';
        html += '<thead style="width: 100%;table-layout: fixed">';
        html += '<tr>';
        html += '<th>Productos</th>';
        html += '<th>Marca</th>';
        html += '<th>Precio venta</th>';
        html += '<th>Precio Compra</th>';
        html += '<th>Cantidad</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody  style="height:5rem;overflow:auto; width: 100%">';



        productfiltersBuscador.forEach(element => {
            html += '<tr>';
            html += '<td>' + element.Nombre_producto + '</td>';
            html += '<td>' + element.Marca + '</td>';
            html += '<td>' + element.Precio_venta + '</td>';
            html += '<td>' + element.costo + '</td>';
            html += '<td>' + element.Cantidad + '</td>';
            html += '<td><button class="btn btn-outline-dark" onclick="cargarProducto(' + element.id_product + ')"><i class="bi bi-bag-plus"> Agregar</i></button></td>';
            html += '</tr>';
        });


        html += '</tbody>';
        html += '</table>';
        //con el inner html, inyectamos la tabla en el div con este id, en el modal
        document.getElementById("buscar_producto_proveedor").innerHTML = html;
    }

        function cargarNumeroFactura() {
        var numfactura = document.getElementById("numeroFactura").value;
        //se manda al input ihidden del formulario
        document.getElementById("numeroFactura").value = numfactura;
        // se manda al titulo del modal
        document.getElementById("numfact_form").innerHTML = '<span>'+numfactura+'</span>';
    }




    function guardatFactura() {

        //validaciones
        if (document.getElementById("numeroFactura").value == '') {
            alertify.error("El numero de la factura es obligatorio");
            return;
        }
        if (document.getElementById("clienteFactura").value == '') {
            alertify.error("El cliente es obligatorio");
            return;
        }
        if (detallefactura.length == 0) {
            alertify.error("Debe de agregar detalles");
            return;
        }


        //armamos el json con los campos de ls DB
        var jsonFactura = {
            numeroFactura: document.getElementById("numeroFactura").value
            , fechaFactura: document.getElementById("fechaFactura").value
            , empleadoVentas: document.getElementById("empleadoVentas").value
            , clienteFactura: document.getElementById("clienteFactura").value
            , garantia: document.getElementById("switchGarantia").checked ? 'si': 'no'
            , id_rango: document.getElementById("id_rango").value
            , Total_factura: totalFACTURA
        };

        swal.fire({
                title: '¿Está seguro que desea guardar los datos?',
                icon: 'question',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }
            , function() {

            }).then((result)=>{
                if (result.isConfirmed) {
                    //pasamos lo el json, y el arreglo de detalles, a string para que se manden como parametros por la ruta
                var stringarrayFactura = JSON.stringify(jsonFactura);
                var stringarrayDetalles = JSON.stringify(detallefactura);


                    window.location.href = `{{URL::to('/guardarventa/` + stringarrayFactura + `/` + stringarrayDetalles + `')}}`;

                }
            })
            event.preventDefault()

    }

</script>



<script>




    var d = new Date();
    var offset = -6; // offset para la hora de Honduras en GMT
    d.setHours(d.getHours() + offset);
    document.getElementById("fecha_desde").min = d.toISOString().split("T")[0];
    d.setMonth(d.getMonth() + 1);
    document.getElementById("fecha_hasta").min = d.toISOString().split("T")[0];

    function validar(event) {
        // se obtiene el valor actual del carácter presionado en el teclado y se almacena en la variable value
        var value = event.key;
        //se obtiene el valor actual del elemento facturaFinal y se almacena en la variable texto
        var input = this;
        var texto = input.value;

        /*
            La función isNaN se utiliza para determinar si un valor es un
            número o no. parseInt se utiliza para convertir una cadena en
            un número entero. Si el valor actual no es un número,
            se cancela el evento predeterminado
            (utilizando event.preventDefault()) y se detiene la ejecución
            del controlador de eventos
        */
        if (isNaN(parseInt(event.key))) {
            event.preventDefault();
            return;
        }

        /*
            se comprueba si la longitud del texto actual es 3, 7 o 10 caracteres y,
            si es así, se agrega un guion al final del texto
            para simular el formato especificado por la SAR (XXX-XXX-XX-XXXXXXXX)
        */
        if (texto.length == 3 || texto.length == 7 || texto.length == 10) {
            texto += '-';
            /*
                valor resultante con los guiones se asigna
                de nuevo al elemento facturaFinal y se mostrará
                en el campo de texto HTML.
            */
            input.value = texto;
        }

    }
    //se agrega un controlador de eventos para el evento keypress en el elemento con id facturaFinal
    document.getElementById("rango_desde").addEventListener("keypress", validar);
    //se agrega un controlador de eventos para el evento keypress en el elemento con id facturaInicial
    document.getElementById("rango_hasta").addEventListener("keypress", validar);





    function cargarProducto(select) {


        if (select == '') {
            limpiarform();
        } else {
            // buscar el producto por el value del input,(id_producto)
            pro = @json($products).filter((x) => x.id_product == select);


            if (parseInt(pro[0].Cantidad) === 0) {
                alertify.error("No puede agregarlo, porque no hay productos en el Inventario");
                return;
            }

            //asignamos los valores a las cajas del modal, y alas las hidden tambien
            document.getElementById("id_product").value = pro[0].id_product;
            document.getElementById("id_prov").value = pro[0].id_prov;
            document.getElementById("id_cat").value = pro[0].id_cat;
            document.getElementById("nombre_producto").value = pro[0].Nombre_producto;
            document.getElementById("Marca").value = pro[0].Marca;
            document.getElementById("Descripcion").value = pro[0].Descripcion;
            document.getElementById("Cantidad").value = 1;
            document.getElementById("CantidadExistencia").value = pro[0].Cantidad;
            document.getElementById("Costo").value = 0;
            document.getElementById("Precio_venta").value = pro[0].Precio_venta;
            document.getElementById("Impuesto").value = pro[0].Impuesto;


            //mostramos y escondemos los botones que necesitan
            document.getElementById("AgregarDF").style.display = 'block';
            document.getElementById("AgregarDFC").style.display = 'block';
            document.getElementById("ActualizarDF").style.display = 'none';
            document.getElementById("ActualizarDFC").style.display = 'none';
        }
    }


    function limpiarformbase() {
        document.getElementById("Nombre_producto_form").value = '';
        document.getElementById("Marca_form").value = '';
        document.getElementById("Descripcion_form").value = '';
        document.getElementById("categoria_form").value = '';
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

    function uuidv4() {
        return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        );
    }



    function AgregarDetalle() {

        var nombre_producto = document.getElementById("nombre_producto").value;
        var Marca = document.getElementById("Marca").value;
        var Descripcion = document.getElementById("Descripcion").value;
        var Cantidad = document.getElementById("Cantidad").value;
        var CantidadExistencia = document.getElementById("CantidadExistencia").value;
        var Costo = document.getElementById("Costo").value;
        var Precio_venta = document.getElementById("Precio_venta").value;


        if (parseInt(CantidadExistencia) === 0) {
            alertify.error("No hay existencia en el inventario");
            return;
        }


        if (nombre_producto == '') {
            alertify.error("Seleccionar producto");
            return;
        }

        if (Marca == '') {
            alertify.error("Seleccionar producto");
            return;
        }

        if (Descripcion == '') {
            alertify.error("Seleccionar producto");
            return;
        }

        if (Cantidad == '') {
            alertify.error("La cantidad es obligatoria");
            return;
        }
        if (Cantidad == 0) {
            alertify.error("La cantidad no debe ser cero");
            return;
        }

        if (parseInt(Cantidad) > parseInt(CantidadExistencia)) {
            alertify.error("La cantidad no debe de exeder la existencia");
            return;
        }


        if (Precio_venta == '') {
            alertify.error("El precio de venta es obligatorio");
            return;
        }

        if (Precio_venta == 0) {
            alertify.error("El precio de venta no debe ser cero");
            return;
        }

        if (parseFloat(Precio_venta) < parseFloat(Costo)) {
            alertify.error("El precio de venta no debe ser menor al precio de compra");
            return;
        } else if (parseFloat(Precio_venta) == parseFloat(Costo)) {
            alertify.error("El precio de venta no debe ser igual al precio de compra");
            return;
        }



        //    armamos el json de los stringarrayDetalles
        //    con un uuid, para poder actualizarlo, incluso cuando aun no se ha guardado
        //    para eso utilizamos la funcion uuidv4
        var jsonproducto = {
             "id_detalle": uuidv4()
            , "id_product": document.getElementById("id_product").value
            , "id_prov": document.getElementById("id_prov").value
            , "id_cat": document.getElementById("id_cat").value
            , "Numero_facturaform": document.getElementById("Numero_facturaform").value
            , "nombre_producto": nombre_producto
            , "Marca": Marca
            , "Descripcion": Descripcion
            , "Cantidad": Cantidad
            , "Costo": Costo
            , "Precio_venta": Precio_venta
            , "Impuesto": document.getElementById("Impuesto").value
            , "existencia": parseInt(CantidadExistencia)
        };

        var existe = 0;
        var iddetalleactualizar = "";
        var nuevacantidad = 0;

        detallefactura.forEach(element => {
            if (element.id_product == jsonproducto.id_product && element.Impuesto == jsonproducto.Impuesto) {
                existe++;
                iddetalleactualizar = element.id_detalle
                nuevacantidad = (parseFloat(element.Cantidad) + parseFloat(jsonproducto.Cantidad));



                if (parseInt(nuevacantidad) > parseInt(CantidadExistencia)) {
                    alertify.error("La cantidad no debe de exeder la existencia");
                    return;
                }


                element.Cantidad = nuevacantidad
                element.Costo = jsonproducto.Costo;
                element.Precio_venta = jsonproducto.Precio_venta;
            }
        });

        if (existe == 0) {
            if (accion == 'editar') {
                $.ajax({
                    type: "POST"
                    , url: '/agregardetallepro'
                    , data: {
                        "_token": "{{ csrf_token() }}"
                        , "data": jsonproducto
                    }
                    , success: function(data) {
                        console.log(data);
                    }
                })
            }
            detallefactura.push(jsonproducto);
        } else {
            if (accion == 'editar') {
                let editdetpro = {
                    "id": iddetalleactualizar
                    , "Cantidad": nuevacantidad
                    , "Costo": jsonproducto.Costo
                    , "Precio_venta": jsonproducto.Precio_venta
                    , "Impuesto": jsonproducto.Impuesto
                }

                $.ajax({
                    type: "POST"
                    , url: '/editardetallepro'
                    , data: {
                        "_token": "{{ csrf_token() }}"
                        , "data": editdetpro
                    }
                    , success: function() {
                        console.log("Valueadded");
                    }
                })
            }
        }




        dibujarTabla(detallefactura);
        limpiarform()
        buscarydibujarProductos()

    }


    function eliminardetalle(id_detalle) {
        swal.fire({
                title: '¿Desea eliminar este detalle?',
                icon: 'question',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }
            , function() {
            }).then((result)=>{
                if (result.isConfirmed) {
                    // excluir el json del array, diciendole que el id sea diferente
                    detallefactura = detallefactura.filter((x) => x.id_detalle != id_detalle)

                    //eliminar de la base de datos, solo si estamos en editar
                    if (accion == 'editar') {
                        $.ajax({
                            type: "POST"
                            , url: '/eliminardetallepro'
                            , data: {
                                "_token": "{{ csrf_token() }}"
                                , "data": id_detalle
                            }
                            , success: function() {
                                console.log("Valueadded");
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

    function editardetalle(id_detalle) {

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
        document.getElementById("Cantidad").value = detalleaeditar[0].Cantidad;
        document.getElementById("Costo").value = detalleaeditar[0].Costo;
        document.getElementById("Precio_venta").value = detalleaeditar[0].Precio_venta;
        document.getElementById("Impuesto").value = detalleaeditar[0].Impuesto;
        document.getElementById("CantidadExistencia").value = detalleaeditar[0].existencia;





        // cambiamos los botones a actualizar
        document.getElementById("AgregarDF").style.display = 'none';
        document.getElementById("AgregarDFC").style.display = 'none';
        document.getElementById("ActualizarDF").style.display = 'block';
        document.getElementById("ActualizarDFC").style.display = 'block';

        if (parseFloat(Precio_venta) < parseFloat(Costo)) {
            alertify.error("El precio de venta no debe ser menor al precio de compra");
            return;
        } else if (parseFloat(Precio_venta) == parseFloat(Costo)) {
            alertify.error("El precio de venta no debe ser igual al precio de compra");
            return;
        }

    }

    function ActualizarDetalle() {
        //copiamos las mismas validacion de agregar
        var Cantidad = document.getElementById("Cantidad").value;
        var Costo = document.getElementById("Costo").value;
        var Precio_venta = document.getElementById("Precio_venta").value;
        var CantidadExistencia = document.getElementById("CantidadExistencia").value;

        if (Cantidad == '') {
            alertify.error("La cantidad es obligatorio");
            return;
        }
        if (Cantidad == 0) {
            alertify.error("La cantidad no debe ser cero");
            return;
        }
        if (Precio_venta == '') {
            alertify.error("El precio de venta es obligatorio");
            return;
        }
        if (Precio_venta == 0) {
            alertify.error("El precio de venta no debe ser cero");
            return;
        }

        if (parseInt(Cantidad) > parseInt(CantidadExistencia)) {
            alertify.error("La cantidad no debe de exeder la existencia");
            return;
        }


        if (parseFloat(Precio_venta) < parseFloat(Costo)) {
            alertify.error("El precio de venta no debe ser menor al precio de compra");
            return;
        } else if (parseFloat(Precio_venta) == parseFloat(Costo)) {
            alertify.error("El precio de venta no debe ser igual al precio de compra");
            return;
        }

        //obtener el id del detalle que vamos a actualizar, con los valores de las cajas
        var iddetalleinput = document.getElementById("id_detalle").value;
        //recooremos la varible global del la vista,(detallefactura)

        let editdetpro = {
            "id": iddetalleinput
            , "Cantidad": Cantidad
            , "Costo": Costo
            , "Precio_venta": Precio_venta
            , "Impuesto": document.getElementById("Impuesto").value
        , }


        $.ajax({
            type: "POST"
            , url: '/editardetallepro'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "data": editdetpro
            }
            , success: function() {
                console.log("Valueadded");
            }
        })


        detallefactura.forEach(element => {
            // y donde coincida, darle los mismos valores de la cajas al elemento
            if (element.id_detalle == iddetalleinput) {


                if (parseInt(Cantidad) > parseInt(CantidadExistencia)) {
                    alertify.error("La cantidad no debe de exeder la existencia");
                    return;
                }


                element.Cantidad = Cantidad;
                element.Costo = Costo;
                element.Precio_venta = Precio_venta;
                element.Impuesto = document.getElementById("Impuesto").value;
            }
        });

        //dibujamosla tabla para que se mire el campo, y regresamos los botones, y limpiamos los campos
        dibujarTabla(detallefactura);
        limpiarform();
        document.getElementById("AgregarDF").style.display = 'block';
        document.getElementById("AgregarDFC").style.display = 'block';
        document.getElementById("ActualizarDF").style.display = 'none';
        document.getElementById("ActualizarDFC").style.display = 'none';
    }



    function limpiarform() {
        document.getElementById("nombre_producto").value = '';
        document.getElementById("Marca").value = '';
        document.getElementById("Descripcion").value = '';
        document.getElementById("Cantidad").value = '';
        document.getElementById("Costo").value = '';
        document.getElementById("Precio_venta").value = '';
        document.getElementById("Impuesto").value = '';
        document.getElementById("id_product").value = '';
        document.getElementById("id_prov").value = '';
        document.getElementById("id_cat").value = '';
        document.getElementById("inputBuscarProveedor").value = '';
    }


    function validarCai(event) {
        var value = event.key;
        var input = this;
        var texto = input.value;
        if (isNaN(parseInt(event.key, 16))) {
            event.preventDefault();
            return;
        }
        if (texto.length == 6 || texto.length == 13 || texto.length == 20 || texto.length == 27 || texto.length == 34) {
            texto += '-';
            input.value = texto;
        }
    }

    document.getElementById("numero_cai").addEventListener("keypress", validarCai);

</script>





@endsection

@push('scripstss')
@if (session('mensaje'))
<script>
    alertify.success("{{ session('mensaje') }}");
</script>
@endif
@endpush

@include('common')

