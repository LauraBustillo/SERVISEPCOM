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
   margin-bottom: 3% !important;
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

     /*Los titulos */ 
     .titulo3 {
   font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
   color: black;
   font-family: 'Open Sans';
   font-size: 20xp;
 }

 div.container {
        width: 100% !important;
        height: 100% !important;
        padding-left: 10% !important;
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




 div.dataTables_wrapper div.dataTables_filter input {


width: 80% !important;
background-color: transparent;
border: 1.5px solid #000000;
float: left;

margin-bottom: %;
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
 width: 150px !important;
}    
td {
 border-right:solid black 0.1px;
} 

table.dataTable.dataTable_width_auto {
  width: auto;
}

 
 

 
#padre{
  position: relative;
  background-color: transparent;
}

#uno {
  position: absolute;
  background-color: transparent;
  top: 22%;
  left: 90% !important;
  right: 0;
  margin: 0 auto;
  width: 5px;
}

/* De  Aqui*/ 
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



/*El boton cancelar */
a { color: aliceblue;
  outline: none;
  text-decoration: none;
  color: #000000;
}
.a:hover{

    color: white;
}
.select2{
    width: 100% !important;
    height: 30px !important; 
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

{{-- <script  src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.1/api/sum().js"></script>

<script>
    var table2 = '';
    $().ready(function() {
        table2 = $('#myTable2').DataTable({
            'pageLength': 4,
            language: {
                "sProcessing": "Procesando..."
                , "sLengthMenu": ""
                , "sZeroRecords": "No se encontraron resultados"
                , "sEmptyTable": ""
                , "sInfo": ""
                , "sInfoEmpty": ""
                , "sInfoFiltered": ""
                , "sInfoPostFix": ""
                , "sSearch": '<b>Buscar por nombre de cliente, categoría o estado</b>'
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

        var minDate, maxDate;
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'YYYY-M-DD'
        });
        maxDate = new DateTime($('#max'), {
            format: 'YYYY-M-DD'
        });


        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[2]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );


        // Refilter the table
        $('#min, #max').on('change', function() {
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




{{-- Buscador--}}
<h1 class="titulo3" style="text-align:center">Listado de mantenimiento de equipos</h1> 
<br>
<div class="input-group " style="float:right" style="width: 100%" >

  <div class="input-group "  style="display: flex" ><br>
  <div style="width: 20%" >
  <b><label for="" class="group-text">Fecha minima:</label></b>
  <input  class="form-control" id="min" name="min" value=""> 
  </div> &nbsp;&nbsp;
  
  <div style="width: 20%">
    <b><label for="" class="group-text">Fecha  máxima:</label></b>
    <input   class="form-control" id="max" name="max" value="" > 
  </div> &nbsp;&nbsp;

  <div><br>&nbsp;
      <a href="{{ route('mantenimiento.index') }}" class="btn btn-outline-dark" ><i class="bi bi-trash3-fill"></i></a> 
      
  </div>
  <div style="width: 51%"><br>
  <a class="btn btn-outline-dark" style="float:right" href="{{ route('RegistroMantenimiento')}}">
  <i class="bi bi-plus-square-fill"></i></a>
  </div>

<div>
<br>
<div style="display: flex">  
<div style="width:100%" id="padre">
    <table class="table table-striped table-hover table-bordered border-dark"  id="myTable2" style="width: 100%">
    <thead  class="table-dark">
        <tr>
        {{-- <th scope="col">#</th> --}}
        <th >Cliente</th>
        <th >Categoría</th> 
        <th  style="width: 200px;" >Fecha </th>
        <th>Estado</th>
        <th scope="col">Factura #</th>  
        <th scope="col">Total </th> 
        <th  style="text-align: center;" scope="col">Detalle</th>
        <th  style="text-align: center;" scope="col">Editar</th>
        <th  style="text-align: center;" scope="col">Facturar</th> 
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
                        <a class="btn-detalles mr-2" href="{{route('mantenimientos.ver' , ['id' => $m->id]) }}"> <i class="bi bi-file-text-fill"> Detalles</i> </a> &nbsp;&nbsp;
                    </td>
                    <td>
                        @if($m->estado == 'Finalizado' && $m->numero_factura != null)
                        <a class="btn-detalles mr-2" href="{{route('pdf.mantenimiento' , ['id' => $m->id]) }}"> <i class="bi bi-pen-fill"> Imprimir </i> </a> &nbsp;&nbsp;
                        @else
                        <a class="btn-detalles mr-2" href="{{route('mantenimiento.mostrar' , ['id' => $m->id]) }}"> <i class="bi bi-pen-fill"> Editar </i> </a> &nbsp;&nbsp;

                        @endif

                    </td>
                    <td>
                        <a style="color: #000000;text-decoration:none" class="quitar btn-detalles text-black" {{$m->estado == 'Finalizado' ? "" : "hidden"}} onclick="openmodalfacturar({{$m}})"><i class="bi bi-clipboard-check-fill"> Facturar </i> </a>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>




<div class="modal fade" id="modalafacturarMantenimiento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="titulo1">
                    Facturar mantenimiento
                </h3>
            </div>
            <div class="modal-body">

                <input id="id_m" hidden value="">
                <input id="id_r" hidden value="{{ isset($rangoActual[0]->id)?$rangoActual[0]->id:'0' }}">


                <div style="display: flex">
                    <div style="width: 100%">
                    <span class="input-group-text select2"  style="width: 100%">Número factura</span>
                        <input value="{{$num_factura}}" readonly id="numero_facturaM" type="text" maxlength="11" name="numero_facturaM" class="form-control" placeholder="Número factura">
                    </div>
                    &nbsp;&nbsp;
                    <div style="width: 100%">
                    <span class="input-group-text select2"  style="width: 100%">Fecha facturación</span>
                        <input value="{{$fecha_actual}}" readonly id="fecha_facturacionM" type="date" name="fecha_facturacionM" class="form-control" placeholder="Fecha facturación">
                    </div>
                </div>
         <br>
                <div style="display: flex"> 
                    <div style="width: 100%">
                    <span class="input-group-text select2"  style="width: 100%">Precio mantenimiento</span>
                        <input value="{{old('precio_mantenimientoM')}}" id="precio_mantenimientoM" type="text" name="precio_mantenimientoM" class="form-control" maxlength="4" placeholder="Precio mantenimiento">
                    </div>
                    &nbsp;&nbsp;
                    <div style="width: 100%">
                    <span class="input-group-text select2"  style="width: 100%">Descripción</span>
                        <textarea id="descripcion_mantenimiento" type="text" name="descripcion_mantenimiento" class="form-control" maxlength="150" placeholder="Descripción de lo que se realizó en el mantenimiento" rows="1">{{old('descripcion_mantenimiento')}}</textarea>
                    </div>
                </div>

                <div class="modal-footer" style="text-align: center">
                    <button type="button" class="button button-blue " onclick="cerrarmodalfacturar()"><i class="bi bi-x-circle"> Cerrar</i></button>
                    <button type="button" class="button button-blue "  onclick="guardarfacturar()"><i class="bi bi-folder-fill"> Guardar</i></button>
                </div>
            </div>

        </div>
    </div>
</div>



<script>
    var myModalFacturar = new bootstrap.Modal(document.getElementById('modalafacturarMantenimiento'));

    function openmodalfacturar(mante) {
        myModalFacturar.show();
        document.getElementById('id_m').value = mante.id;
        if (mante.numero_factura == null) {

        } else {
            document.getElementById('numero_facturaM').value = mante.numero_factura;
        }

        if (mante.fecha_facturacion == null) {

        } else {
            document.getElementById('fecha_facturacionM').value = mante.fecha_facturacion;
        }


        document.getElementById('precio_mantenimientoM').value = mante.precio;
        document.getElementById('descripcion_mantenimiento').value = mante.descripcion;
    }

    function cerrarmodalfacturar() {
        myModalFacturar.hide();
    }

    function guardarfacturar() {

        var id_m = document.getElementById('id_m').value;
        var id_r = document.getElementById('id_r').value;
        var numero_facturaM = document.getElementById('numero_facturaM').value;
        var fecha_facturacionM = document.getElementById('fecha_facturacionM').value;
        var precio_mantenimientoM = document.getElementById('precio_mantenimientoM').value;
        var descripcion_mantenimiento = document.getElementById('descripcion_mantenimiento').value;

        //hacer las validaciones

        var numeros = /([0-9])/;



        if (document.getElementById("numero_facturaM").value == '') {
            alertify.error("El número de factura es requerido");
            return;

        } else if (numero_facturaM.length > 20) {
            alertify.error('El número de factura el máximo es de 19 caracteres')
            return;
        } else if (numero_facturaM.length < 18) {
            alertify.error('El número de factura el mínimo es de 19 caracteres')
            return;
        } else if (!numeros.test(numero_facturaM)) {
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

        } else if (precio_mantenimientoM.length < 2) {
            alertify.error('El precio, mínimo debe tener 2 caracteres');
            return;
        } else if (!numeros.test(precio_mantenimientoM)) {
            alertify.error("El precio solo debe tener números ");
            return;

        }

        // Descripcion
        if (document.getElementById("descripcion_mantenimiento").value == '') {
            alertify.error("La descripción es requerida");
            return;
        }
        else if (descripcion_mantenimiento.length > 150) {
            alertify.error('La descripción no debe de tener más de 150 letras')
            return;
        }



        var datosMant = {
            "id_m": id_m
            , "id_r": id_r
            , "numero_facturaM": numero_facturaM
            , "fecha_facturacionM": fecha_facturacionM
            , "precio_mantenimientoM": precio_mantenimientoM
            , "descripcion_mantenimiento": descripcion_mantenimiento
        };

        $.ajax({
            type: "POST"
            , url: '/guardarFacturaMantenimiento'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "data": datosMant
            }
            , success: function(data) {
                // obtenemos el resuldo retornado por la funcion del controlador, que nos retorno el cliente que anadimos
                // y ese cliente nuevo se lo agregamos a nuestra variable global,
                window.location.href = `{{URL::to('/ListadoMantenimiento')}}`;
            }
        })

    }

    window.onload = function() {
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth() + 1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        if (dia < 10)
            dia = '0' + dia; //agrega cero si el menor de 10
        if (mes < 10)
            mes = '0' + mes //agrega cero si el menor de 10
        document.getElementById('fecha_facturacionM').value = ano + "-" + mes + "-" + dia;

    }

</script>


@endsection
@include('common')

