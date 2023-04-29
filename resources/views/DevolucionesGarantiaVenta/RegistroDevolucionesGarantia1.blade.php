@extends('main')
@section('extra-content')

<style>
    /*Cajas de texto*/
    .form-control {
        background-color: transparent;
        border: 1.3px solid #000000;
        height: fit-content;
    }

    .form-control2 {
        background-color: rgb(145, 203, 223);
        height: fit-content;
        padding: 1rem;
        border-radius: 1rem;
    }
        /*Los titulos */ 
    .titulo2 {
    font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
    color: #4c4d4e;;
    
    font-family: 'Open Sans';
    font-size: 20px;
    }

        /*Las label*/ 
    .input-group-text  {
    background-color: #4c4d4e;;
    border: 1.3px solid #4c4d4e;;
    font-family: 'Open Sans';
    color: #FFFFFF;

    }


    /*Cajas de texto*/
    .form-control1 {
        background-color: white;
        border: 1.3px solid #000000;
        height: fit-content;
        padding: 1rem;
    }

    .select1{
    width: 100% !important;
    height: 40px !important;
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
        color: #4c4d4e;;
        
        font-family: 'Open Sans';
        font-size: 20xp;
        }

    .titulo1 {
        font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
        color: black;
        font-family: 'Open Sans';
        font-size: 30px;
        text-align: center;
    }

    .letra {
        font-weight: bold;
    }


    .inputCliente {
        background: transparent;
        border: none;
        width: 100%;
        outline: none;
    }

    .modal-content {
        background-color: rgb(184, 234, 249) !important;
    }

    div.dataTables_wrapper div.dataTables_filter input {

        display: inline-block;
        width: 120% !important;
        background-color: transparent;
        border: 1.5px solid #000000;
        float: left;
    }

    .dataTables_wrapper .dataTables_filter {
        float: left !important;
        text-align: left !important;
        width: 100% !important;

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

    div.container {

width: 100% !important;
height: 100% !important;
padding-left: 10% !important;
}
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.1/api/sum().js"></script>

{{--Para los reportes--}}

<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

<script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

{{-- Darle forma a los borones de reporte--}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<br>


<script>
    var errores = []
    errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!};
    if(errores.length > 0){
      errores.forEach(element => {
        alertify.error(element)
      });
    }
  </script>

<script>
    $().ready(function() {
        $('#myTable').DataTable({

            pageLength: 4
            , lengthMenu: [
                [5, 10, 20, -1]
                , [5, 10, 20, 'Todos']
            ]
            , language: {
                "sProcessing": "Procesando..."
                , "sLengthMenu": ""
                , "sZeroRecords": "No se encontraron resultados"
                , "sEmptyTable": ""
                , "sInfo": ""
                , "sInfoEmpty": ""
                , "sInfoFiltered": ""
                , "sInfoPostFix": ""
                , "sSearch": '<b>Buscar por número de factura</b>'
                , "sUrl": "."
                , "sInfoThousands": ""
                , "sLoadingRecords": "Cargando..."
                , "oPaginate": {
                    "sFirst": "Primero"
                    , "sLast": "Último"
                    , "sNext": "Siguiente"
                    , "sPrevious": "Anterior"
                }
                , "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente"
                    , "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
                , "buttons": {
                    "copy": "Copiar"
                    , "colvis": "Visibilidad"
                }
            }

        });

        $('#tablebuscarinventario').DataTable({

            pageLength: 4
            , lengthMenu: [
                [5, 10, 20, -1]
                , [5, 10, 20, 'Todos']
            ]
            , language: {
                "sProcessing": "Procesando..."
                , "sLengthMenu": ""
                , "sZeroRecords": "No se encontraron resultados"
                , "sEmptyTable": ""
                , "sInfo": ""
                , "sInfoEmpty": ""
                , "sInfoFiltered": ""
                , "sInfoPostFix": ""
                , "sSearch": "Buscar por número de factura"
                , "sUrl": "."
                , "sInfoThousands": ""
                , "sLoadingRecords": "Cargando..."
                , "oPaginate": {
                    "sFirst": "Primero"
                    , "sLast": "Último"
                    , "sNext": "Siguiente"
                    , "sPrevious": "Anterior"
                }
                , "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente"
                    , "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
                , "buttons": {
                    "copy": "Copiar"
                    , "colvis": "Visibilidad"
                }
            }

        });



    });

</script>


{{--Mostrar funcion--}}
<script>
    var errores = []
    errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!};
    if(errores.length > 0){
      errores.forEach(element => {
        alertify.error(element)
      });
    }

  </script>
<form class="form-control" id="form_devolucionGarantia" name="form_devolucionGarantia" action="{{ route('store.devolucion') }}" method="POST" style="text-align: center;" onsubmit="guardarDevolucionGarantia()">
    @csrf
    <br>
    {{-- Título --}}

    <div class="input-group input-group-sm mb-1" style="display: flex">
        <div style="width: 100%" class="form-check form-switch">
            <H1 class="titulo">Registrar devolución por garantía</H1>
        </div>


    </div>
    <br>
   
    <div class="row">
        <table id="myTable" class="table table-hover">
            <thead>
                <tr>

                    <th scope="col" style="text-align: center">Número de factura</th>
                    <th scope="col" style="text-align: center">Fecha de facturación</th>
                    <th scope="col" style="text-align: center">Cliente</th>
                    <th scope="col" style="text-align: center">Ver</th>
                </tr>
            </thead>



            <tbody>
                @forelse($ventas as $de)
                <tr>
                    <td scope="row">{{ $de->numeroFactura}}</td>
                    <td>{{ $de->fechaFactura }}</td>
                    <td>{{ $de->clienteFactura}}</td>
                    <td>
                        <a class="btn btn-outline-dark" onclick="agregarproductoventa('{{ $de->detalles }}','{{ $de->numeroFactura }}')">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>

                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    <br><br>

    <br>
    <div class="card-header"  style="display: flex">
      <h6 style="font-size: 31px" class="mx-auto letra titulo2" >Datos del producto en devolución</h6>
    </div>
     <br>


    {{---Nombre del producto --}}
    <div style="display: flex">
              {{--- número de factura --}}
        <div class="col" style="width: 25%">
            <span class="input-group-text" id="inputGroup-sizing-sm">Número de factura</span> 
            <input type="text" readonly required maxlength="25" name="Numero_de_factura" id="Numero_de_factura" class="form-control" placeholder="Número de factura" aria-label="First name" value="{{old('Numero_de_factura')}}">
        </div>

        &nbsp;&nbsp;
        <div class="col" style="width: 25%">
            <span class="input-group-text" id="inputGroup-sizing-sm">Nombre del producto</span> 
            <input type="text" name="id_detalle_venta" id="id_detalle_venta" readonly style="display: none" value="{{old('id_detalle_venta')}}">
            <input type="number" name="id_producto_devolucion" id="id_producto_devolucion" readonly style="display: none" value="{{old('id_producto_devolucion')}}">
            <input type="text" readonly required maxlength="25" name="Nombre_producto_devolucion" id="Nombre_producto_devolucion" class="form-control" placeholder="Nombre del producto" aria-label="First name" value="{{old('Nombre_producto_devolucion')}}">
        </div>


        &nbsp;&nbsp;
        {{--- Marca del producto--}}
        <div class="col" style="width: 25%">
            <span class="input-group-text" id="inputGroup-sizing-sm">Marca del producto</span> 
            <input type="text" readonly required maxlength="25" name="Marca_Devolucion" id="Marca_Devolucion" class="form-control" placeholder="Marca del producto" aria-label="First name" value="{{old('Marca_Devolucion')}}">
        </div>

        &nbsp;&nbsp;
        {{--- Categoría --}}
        <div class="col" style="width: 25%">
            <span class="input-group-text" id="inputGroup-sizing-sm">Categoría</span> 
            <input type="text" readonly required maxlength="25" name="categoria_Devolucion" id="categoria_Devolucion" class="form-control" placeholder=" Categoría del producto" aria-label="First name" value="{{old('categoria_Devolucion')}}">
        </div>

    </div>
    <br>
    <div style="display: flex">
         {{--- Proveedor--}}
         <div style="width: 24.5%">
            <span class="input-group-text" id="inputGroup-sizing-sm">Proveedor</span> 
            <input type="text" readonly required maxlength="25" name="proveedor_devolucion" id="proveedor_devolucion" class="form-control" placeholder="Nombre del proveedor" aria-label="First name" value="{{old('proveedor_devolucion')}}">
        </div>

        &nbsp;&nbsp;
        <div style="width: 24.5%">
            {{--- Fecha de devolución --}}
            <span class="input-group-text" id="inputGroup-sizing-sm">Fecha de devolución</span> 
            <input type="date" readonly name='fechaDev' value="{{  $fecha_actual   }}" id='fechaDev' class="form-control select1">
        </div> &nbsp;&nbsp;

         {{--- escripción--}}
        <div  class="col" style="width: 50%">
            <span class="input-group-text" id="inputGroup-sizing-sm">Descripción</span> 
            <textarea name='des_devolucion' id='des_devolucion' class="form-control" maxlength="255" onkeyup="app.inputKeyUpDirect(this);" rows="1" >{{old('des_devolucion')}}</textarea>
        </div>

       
       


    </div>
    <br><br>



    <div class="col" style="padding-left:2%">
        {{--Botones --}}
        <button class="boton1 button button-blue" type="submit"><i class="bi bi-folder-fill"> Guardar</i></button>
        <button type="reset" class="boton1 button button-blue"> <i class="bi bi-eraser-fill"> Limpiar</i></button>
            <a class="button button-blue" href="{{route('devolucion.index')}}"><i class="bi bi-x-circle-fill"> Cerrar</i> </a>
    </div>
</form>


<!-- Modal de dialogo de agregar productos -->
<div class="modal fade" id="modalagregarproductoventa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="titulo1" id="titulo_modal">Devolver Producto</h3>
            </div>
            <div class="modal-body" id="tbody_agregar_detalle">
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

                    <tbody >

                    </tbody>
                </table>
            </div>
            <!-- Botones -->
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"><i class="bi bi-x-circle"> Cancelar</i></button>
            </div>
        </div>
    </div>
</div>

<script>
    var modalagregarproductoventa = new bootstrap.Modal(document.getElementById('modalagregarproductoventa'));

</script>
@endsection

{{--mensaje de confirmacion --}}
@push('alertas')
<script>
    let detalles = [];

    function dibujarTabla(data,numFactura) {

        var html = ''
        var datosJson = JSON.parse(data,numFactura);

        document.getElementById('tbody_agregar_detalle').innerHTML = html;


        html += '<table id="tablebuscarinventario" class="table table-hover tablacompras"> <br>\
                    <thead>\
                        <tr>\
                            <th scope="col">Categoria</th>\
                            <th scope="col">Marca</th>\
                            <th scope="col">Nombre Producto </th>\
                            <th scope="col">Cantidad </th>\
                            <th scope="col">Agregar</th>\
                        </tr>\
                    </thead>\
                    <tbody >';

        //TABLA GRANDE AFUERA
        if (datosJson.length > 0) {

            datosJson.forEach(element => {
                html += '<tr>';
                html += '<td>' + element.Categoria + '</td>';
                html += '<td>' + element.Marca + '</td>';
                html += '<td>' + element.nombre_producto + '</td>';
                html += '<td>' + element.Cantidad + '</td>';
                var el = JSON.stringify(element);
                html += "<td><button onclick='agregarDevolucion(" + el + ",`"+numFactura+"`)' type='button' class='btn btn-outline-dark'><i class='bi bi-arrow-left-square'></i></button></td>";
                html += '</tr>';
            });

        }


        html +=   '</tbody>\
                </table>';


        document.getElementById('tbody_agregar_detalle').innerHTML = html;

        $('#tablebuscarinventario').DataTable({

            pageLength: 4
            , lengthMenu: [
                [5, 10, 20, -1]
                , [5, 10, 20, 'Todos']
            ]
            , language: {
                "sProcessing": "Procesando..."
                , "sLengthMenu": ""
                , "sZeroRecords": "No se encontraron resultados"
                , "sEmptyTable": ""
                , "sInfo": ""
                , "sInfoEmpty": ""
                , "sInfoFiltered": ""
                , "sInfoPostFix": ""
                , "sSearch": "Buscar por nombre o marca"
                , "sUrl": "."
                , "sInfoThousands": ""
                , "sLoadingRecords": "Cargando..."
                , "oPaginate": {
                    "sFirst": "Primero"
                    , "sLast": "Último"
                    , "sNext": "Siguiente"
                    , "sPrevious": "Anterior"
                }
                , "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente"
                    , "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
                , "buttons": {
                    "copy": "Copiar"
                    , "colvis": "Visibilidad"
                }
            }

        });

    }

    function agregarDevolucion(element,numFactura) {
        document.getElementById('id_detalle_venta').value = element.id_detalle;
        document.getElementById('id_producto_devolucion').value = element.id_product;
        document.getElementById('proveedor_devolucion').value = element.Proveedor;
        document.getElementById('categoria_Devolucion').value = element.Categoria;
        document.getElementById('Marca_Devolucion').value = element.Marca;
        document.getElementById('Nombre_producto_devolucion').value = element.nombre_producto;
        document.getElementById('Numero_de_factura').value = numFactura;


    }

    



    function agregarproductoventa(data,numFactura) {
        modalagregarproductoventa.show();

        dibujarTabla(data,numFactura);

        document.getElementById('titulo_modal').innerHTML = 'Detalles de la Factura N# '+numFactura;

    }



    function guardarDevolucionGarantia() {
        var formul = document.getElementById("form_devolucionGarantia");

        Swal.fire({
            title: '¿Está seguro que desea aceptar esta devolución?'
            , icon: 'question'
            , confirmButtonColor: '#3085d6'
            , showCancelButton: true
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Si'
            , cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                formul.submit();
            }
        })
        event.preventDefault()
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
@endpush

@include('common')
