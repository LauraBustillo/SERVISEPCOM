@extends('main')
@section('extra-content')

<style>
    .input-group-text {
        background-color: #B8D7F9;
        border: 1px solid #0319C4;
    }

    .form-control {
        background-color: transparent;
        border: 1px solid #0319C4;
    }

    .btn-info {
        background-color: transparent;
        border: 1px solid #0319C4;
    }

    /*Los titulos */
    .titulo {
        font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
        color: black;
        font-family: 'Open Sans';
        font-size: 20px;
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

</style>

<h1 class="titulo1">Información de la devolución</h1>
<br>

<div>
    <div class="titulo"> Devolución N°: {{ $devoluciones->id }}</div>
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
                <td>Número de factura</td>
                <td>{{ $devoluciones->detalle_venta->Numero_facturaform }}</td>

            </tr>


            <tr>
                <td>Nombre del producto</td>
                <td>{{ $devoluciones->producto->Nombre_producto }}</td>

            </tr>
            <tr>
                <td>Marca del producto</td>
                <td>{{ $devoluciones->producto->Marca }}</td>


            </tr>
            <tr>
                <td>Categoría</td>
                <td>{{ $devoluciones->Categoria->Descripcion }}</td>

            </tr>
            <tr>
                <td>Proveedor</td>
                <td>{{ $devoluciones->Proveedor->Nombre_empresa }}</td>

            </tr>
            <tr>
                <td>Descripción</td>
                <td>{{ $devoluciones->Descripcion }}</td>

            </tr>
            <tr>
                <td>Fecha de devolución</td>
                <td>{{ $devoluciones->Fecha_devolucion }}</td>
            </tr>
            <tr>
                <td>Fecha de facturación</td>
                <td>{{ $devoluciones->venta->fechaFactura }}</td>
            </tr>
            <tr>
                <td><label>Estado de devolución</label></td>
                <td>
                    <input @if($devoluciones->estado_devolucion == 'Realizado')
                    checked
                    @endif class="form-check-input" type="checkbox" id="switchDev" name="switchDev">
                    <b></b>
                </td>
            </tr>

        </tbody>
    </table>
</div>
<br>


<div style="display: flex">  
    <div style="display: flex" class="mx-auto">
    
<a class="btn btn-outline-dark" href="{{ route('devolucion.index') }}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>

&nbsp;

<form action="{{ route('devolucion.editar', [ 'id' => $devoluciones->id ]) }}" method="post">
    @csrf
    <input type="checkbox"  name='check' id="check" style="display: none">
    <button class="btn btn-outline-dark" type="submit" id="btn_form" style="display: none"> <i class="bi bi-repeat" > Actualizar</i></button>
</form>
</div>
</div>

<script>

    switchDev.addEventListener('change', function(element) {
        document.getElementById("check").checked = document.getElementById("switchDev").checked;
        document.getElementById('btn_form').style.display = "block";
    });

</script>




@endsection
@include('common')
