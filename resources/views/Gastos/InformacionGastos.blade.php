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

<h1 class="titulo1">Información del gasto</h1>
<br>

<div>
    <div class="titulo"></div>
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
                <td>Nombre del gastos</td>
                <td>{{ $gastos->nombre_gasto }}</td>

            </tr>


            <tr>
                <td>Tipo de gastos</td>
                <td>{{ $gastos->tipo_gasto }}</td>

            </tr>
            <tr>
                <td>Fecha del gasto </td>
                <td>{{ $gastos->fecha_gasto }}</td>


            </tr>
            <tr>
                <td>Descripción</td>
                <td>{{ $gastos->descripcion_gasto }}</td>

            </tr>
            <tr>
                <td>Total del gasto</td>
                <td>Lps. {{ $gastos->total_gasto }}</td>

            </tr>
            <tr>
                <td>Responsable del gasto</td>
                <td>{{ $gastos->responsable_gasto }}</td>

            </tr>

        </tbody>
    </table>
</div>
<br>


<div style="display: flex">  
    <div style="display: flex" class="mx-auto">
    
<a class="btn btn-outline-dark" href="{{ route('gasto.index') }}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>

&nbsp;

<form  method="post">
    @csrf
    <input type="checkbox"  name='check' id="check" style="display: none">
    <button class="btn btn-outline-dark" type="submit" id="btn_form" style="display: none"> <i class="bi bi-repeat" > Actualizar</i></button>
</form>
</div>
</div>


@endsection
@include('common')
