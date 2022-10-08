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
</style>

@if (session('mensaje'))
<div class="alert alert-success">
  {{session('mensaje')}}
</div>
@endif 


<div>    
    <div class="titulo" >  Información de {{ $ver->Primer_nombre }} {{ $ver->Primer_apellido}} </div>
<br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Campo</th>
                <th>Valor</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Primer nombre</td>
                <td>{{ $ver->Primer_nombre }} </td>
            </tr>  

            <tr>
                <td>Segundo nombre</td>
                <td>{{ $ver->Segundo_nombre }} </td>
            </tr> 

            <tr>
                <td>Primer apellido</td>
                <td>{{ $ver->Primer_apellido }}</td> 
            </tr> 

            <tr>
                <td>Segundo apellido</td>
                <td>{{ $ver->Segundo_apellido }}</td> 
            </tr> 

            <tr>
                <td>Número de identidad</td>
                <td>{{ $ver->Numero_identidad }}</td>
            </tr> 


            <tr>
                <td>Fecha de nacimiento</td>
                <td>{{ $ver->Fecha_nacimiento}}</td>
            </tr> 

            <tr>
                <td>Número de teléfono</td>
                <td>{{ $ver->Numero_telefono}}</td>
            </tr> 

            <tr>
                <td>Salario</td>
                <td>{{ $ver->Salrio}}</td>
            </tr> 

            <tr>
                <td>Fecha de contrato</td>
                <td>{{ $ver->Fecha_contrato}}</td>
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