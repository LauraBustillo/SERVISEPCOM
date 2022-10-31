@extends('main')
@section('extra-content')

<style>
   .input-group-text  {
  background-color: #B8D7F9;
  border: 1px solid #0319C4;
}

.form-control  {
    background-color: transparent;
    border: 1px solid #0319C4;
}

.btn-info{
    background-color: transparent;
    border: 1px solid #0319C4;
}
/*Los titulos */ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color:black;
  font-family: 'Open Sans';
  font-size: 20px;
}
/*Los titulos */ 
.titulo1 {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color:black;
  font-family: 'Open Sans';
  font-size: 40px;
  text-align: center;
}
</style>

@if (session('mensaje'))
<div class="alert alert-success">
  {{session('mensaje')}}
</div>
@endif 

<H1 class="titulo1">Infromación del empleado</H1>
<br>
<div>    
    <div class="titulo" >Empleado: {{ $ver->Nombres }} {{ $ver->Apellidos}} </div>
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
                <td>Nombres</td>
                <td>{{ $ver->Nombres }} </td>
            </tr>  


            <tr>
                <td>Apellidos</td>
                <td>{{ $ver->Apellidos}}</td> 
            </tr> 

            <tr>
                <td>Número de identidad</td>
                <td>{{ $ver->Numero_identidad }}</td>
            </tr> 


            <tr>
                <td>Fecha de nacimiento</td>
                <td>{{ $ver->fechaNacimiento }}</td>
            </tr> 

            <tr>
                <td>Teléfono fijo o celular </td>
                <td>{{ $ver->Numero_telefono}}</td>
            </tr> 

            <tr>
                <td>Salario</td>
                <td>Lps. {{ $ver->Salrio}}</td>
            </tr> 

            <tr>
                <td>Fecha de contrato</td>
                <td>{{ $ver->fechaContrato}}</td>
            </tr> 

            <tr>
                <td>Dirección</td>
                <td>{{ $ver->Direccion }}</td>
            </tr> 

        </tbody>
    </table>
  </div>

  {{--Botones --}}
  <a class="btn btn-outline-dark" href="{{route('empleado.editar', ['id'=>$ver->id])}}"> <i class="bi bi-pen-fill"> Editar </i></a>
  <a class="btn btn-outline-dark" href="{{route('empleado.index')}}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>
  
@include('common')