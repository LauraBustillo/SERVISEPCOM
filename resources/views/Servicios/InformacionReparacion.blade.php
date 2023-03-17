@extends('main')
@section('extra-content')

<style>
    /*Cajas de texto*/
    .form-control {
        background-color: transparent;
        border: 1.3px solid #000000;
    }

    /*Las label*/
    .input-group-text {
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
        color: black;
        font-family: 'Open Sans';
        font-size: 40px;
        text-align: center;
    }

    /*Los titulos */
    .titulo2 {
        font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
        color: black;
        font-family: 'Open Sans';
        font-size: 30px;
        text-align: center;
    }

    .titulo {
        font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
        color: black;
        font-family: 'Open Sans';
        font-size: 20px;
    }

    a {
        color: aliceblue;
        outline: none;
        text-decoration: none;
        color: #000000;
    }

    .a:hover {
        color: white;
    }

    .col1 {
        width: 9%;
    }

    .col2 {
        width: 91%;
    }

    .row {
        display: flex;
        width: 100%;
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

    .ancho {
        background-color: transparent;
        border: 1.8px solid #000000;
        width: 30%;
    }

    .anchoo {
        background-color: transparent;
        border: 1.8px solid #000000;
        width: 25.8%;
    }

    .box {
        display: flex;
    }

    .select,
    option {
        color: rgb(0, 0, 0);

    }

    .select {
        width: 20%;
        height: 15%;
        margin-left: 0.3%;
        border: 1.8px solid #000000;
        border-radius: 0%;

    }
</style>

<h1 class="titulo1">Información de la reparación</h1>
<br>
<div>
    <div class="titulo">Reparación: {{ $detalle->Nombre }} {{$detalle->Apellido}}</div>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Datos</th>
                <th>Información</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Número de identidad</td>
                <td>{{$detalle->Identidad}}</td>
            </tr>

            <tr>
                <td>Teléfono</td>
                <td>{{$detalle->Telefono}}</td>
            </tr>

            <tr>
                <td>Dirección</td>
                <td>{{$detalle->Direccion}}</td>
            </tr>

            <tr>
                <td>Categoría</td>
                <td>{{$detalle->categoria}}</td>
            </tr>
            <tr>
                <td>Nombre equipo</td>
                <td>{{$detalle->nombre_equipo}}</td>
            </tr>

            <tr>
                <td>Marca</td>
                <td>{{$detalle->marca}}</td>
            </tr>
            <tr>
                <td>Modelo</td>
                <td>{{$detalle->modelo}}</td>
            </tr>

            <tr>
                <td>Descripción</td>
                <td>{{$detalle->descripcionr}}</td>
            </tr>

            <tr>
                <td>Foto</td>
                <td>
                    <span {{$detalle->foto != null && $detalle->foto != "" ? "hidden":""}} >No hay fotos para
                        mostrar</span>
                    <a class="btn btn-outline-dark" {{$detalle->foto != null && $detalle->foto != "" ? "":"hidden"}}
                        onclick="abrirmodalfotos()" >Ver imagenes</a>
                </td>
            </tr>

            <tr>
                <td>Cambio de pieza</td>
                <td>{{$detalle->cambio_pieza}} <button class="btn btn-outline-dark" onclick="abrirmodalmodal_piezas()">Ver Piezas</button></td>
            </tr>

            <tr>
                <td>Fecha ingreso</td>
                <td>{{$detalle->fecha_ingreso}}</td>
            </tr>
            <tr>
                <td>Fecha entrega</td>
                <td>{{$detalle->fecha_entrega}}</td>
            </tr>

        </tbody>
    </table>
</div>

{{--Botones --}}
<a class="btn btn-outline-dark" href="{{route('reparacion.mostrar' , ['id' => $detalle->id]) }}"> <i
        class="bi bi-pen-fill"> Editar </i></a>
<a class="btn btn-outline-dark" href="{{route('reparacion.index')}}">
    <i class="bi bi-arrow-left-circle-fill"> Volver
    </i>
</a>
<a class="btn btn-outline-dark" href="{{route('pdf.reparacion',['id' => $detalle->id])}}">
    <i class="bi bi-printer-fill"> Imprimir
    </i>
</a>

<a class="btn btn-outline-dark" href="{{route('pdf.garantia',['id' => $detalle->id])}}">
    <i class="bi bi-award-fill"> Garantia
    </i>
</a>




<!-- Modal de fotos-->
<div class="modal fade" id="modalverfotosreparacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="titulo1">
                    Imagenes equipo
                </h3>
            </div>
            <div class="modal-body">

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <div style="width: 100%;display:flex">
                                <img id="avatarmodal" class="mx-auto" style="width: 15rem;height:15rem;color:black"
                                    alt="no imagen">
                            </div>
                        </div>
                        <div class="carousel-item ">
                            <div style="width: 100%;display:flex">
                                <img id="avatarmodal1" class="mx-auto" style="width: 15rem;height:15rem;color:black"
                                    alt="no imagen">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div style="width: 100%;display:flex">
                                <img id="avatarmodal2" class="mx-auto" style="width: 15rem;height:15rem;color:black"
                                    alt="no imagen">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div style="width: 100%;display:flex">
                                <img id="avatarmodal3" class="mx-auto" style="width: 15rem;height:15rem;color:black"
                                    alt="no imagen">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div style="width: 100%;display:flex">
                                <img id="avatarmodal4" class="mx-auto" style="width: 15rem;height:15rem;color:black"
                                    alt="no imagen">
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>


            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-outline-dark" onclick="cerrarmodalfotosreparacion()"><i
                        class="bi bi-x-circle"> Cerrar</i></button>
            </div>
        </div>
    </div>
</div>


<!-- Modal de fotos-->
<div class="modal fade" id="modal_piezas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="titulo1">
                    Piezas Reparaciones
                </h3>
            </div>
            <div class="modal-body">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marca</th>
                            <th>Categoria</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalle->lista_piezas as $pieza)
                        <tr>
                            <th>{{ $pieza->id_producto }}</th>
                            <th>{{ $pieza->Marca }}</th>
                            <th>{{ $pieza->Categoria }}</th>
                            <th>{{ $pieza->Nombre_producto }}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-outline-dark" onclick="cerrarmodalmodal_piezas()"><i
                        class="bi bi-x-circle"> Cerrar</i></button>
            </div>
        </div>
    </div>
</div>



<script>
    var detalle = {!! json_encode($detalle, JSON_HEX_TAG) !!};
    var myModalVerFotosReparacion = new bootstrap.Modal(document.getElementById('modalverfotosreparacion'));

    var myModalmodal_pieza = new bootstrap.Modal(document.getElementById('modal_piezas'));


    function abrirmodalfotos(){
        myModalVerFotosReparacion.show();
        document.getElementById("avatarmodal").src = detalle.foto;
        document.getElementById("avatarmodal1").src = detalle.foto1;
        document.getElementById("avatarmodal2").src = detalle.foto2;
        document.getElementById("avatarmodal3").src = detalle.foto3;
        document.getElementById("avatarmodal4").src = detalle.foto4;
    }
    function cerrarmodalfotosreparacion(){
        myModalVerFotosReparacion.hide();
    }


    function abrirmodalmodal_piezas(){
        myModalmodal_pieza.show();
    }
    function cerrarmodalmodal_piezas(){
        myModalmodal_pieza.hide();
    }
</script>

@endsection
@include('common')
