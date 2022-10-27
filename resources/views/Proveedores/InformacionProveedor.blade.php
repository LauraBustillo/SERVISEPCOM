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
  font-size: 20px;
  text-align: center;
}
</style>

@if (session('mensaje'))
<div class="alert alert-success">
  {{session('mensaje')}}
</div>
@endif 

 {{-- Título --}}
 <H1 class="titulo1"  style="font-size: 30px text-aling:center"  > Información del proveedor</H1>
 <br>
 

<div>    
    <div class="titulo" >  Proveedor: {{ $ver->Nombre_empresa }} </div>
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
                <td>Nombre de la empresa</td>
                <td>{{ $ver->Nombre_empresa }} </td>
            </tr>  


            <tr>
                <td>Dirección exacta</td>
                <td>{{ $ver->Direccion}}</td> 
            </tr> 

            <tr>
                <td>Correo electrónico</td>
                <td>{{ $ver->Correo}}</td> 
            </tr> 

            <tr>
                <td>Teléfono de la empresa</td>
                <td>{{ $ver->Telefono_empresa }}</td>
            </tr> 


            <tr>
                <td>Nombres del encargado</td>
                <td>{{ $ver->Nombre_encargado}}</td>
            </tr> 

            <tr>
                <td>Apellidos del encargado</td>
                <td>{{ $ver->Apellido_encargado}}</td>
            </tr> 

            <tr>
                <td>Teléfono del encargado</td>
                <td> {{ $ver->Telefono_encargado}}</td>
            </tr> 

        </tbody>
    </table>
  </div>

  {{--Botones pendiente rutas de los botone de editar --}}
  
  <a class="btn btn-outline-dark" href="{{route('proveedor.editar', ['id'=>$ver->id])}}"> <i class="bi bi-pen-fill"> Editar </i></a>
  <a class="btn btn-outline-dark" href="{{route('proveedor.index')}}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>
  
@include('common')