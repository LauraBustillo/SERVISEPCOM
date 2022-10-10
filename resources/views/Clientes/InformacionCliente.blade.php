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

.tabla{
    
}
</style>
<div>    
    <div class="titulo" > Información de {{ $ver->Nombre }} {{ $ver->Apellido}} </div>
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
                <td>Nombres</td>
                <td>{{ $ver->Nombre }}</td>
            </tr>  

            <tr>
                <td>Apellidos</td>
                <td>{{ $ver->Apellido }}</td> 
            </tr> 

            <tr>
                <td>Número de identidad</td>
                <td>{{ $ver->Numero_identidad }}</td>
            </tr> 

            <tr>
                <td>Número de teléfono</td>
                <td>{{ $ver->Numero_telefono}}</td>
            </tr> 

            <tr>
                <td>Dirección</td>
                <td>{{ $ver->Direccion }}</td>
            </tr> 

        </tbody>
    </table>
  </div>
  
  {{--Botones --}}
  <a class="btn btn-outline-dark" href="{{route('cliente.editar', ['id'=>$ver->id])}}"> <i class="bi bi-pen-fill"> Editar </i></a>
  <a class="btn btn-outline-dark" href="{{route('cliente.index')}}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>

@endsection
@include('common')