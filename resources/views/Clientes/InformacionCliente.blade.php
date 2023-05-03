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
  color: #4c4d4e;
  font-family: 'Open Sans';
  font-size: 20px;
}
/*Los titulos */ 
.titulo1 {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #4c4d4e;
  font-family: 'Open Sans';
  font-size: 40px;
  text-align: center;
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

<h1 class="titulo1">Información del cliente</h1>
<br>
<div>    
    <div class="titulo" >Cliente: {{ $ver->Nombre }} {{ $ver->Apellido}} </div>
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
                <td>Teléfono fijo o celular</td>
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
  <a class="button button-blue " href="{{route('cliente.editar', ['id'=>$ver->id])}}"> <i class="bi bi-pen-fill"> Editar </i></a>
  <a class="button button-blue " href="{{route('cliente.index')}}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>

@endsection  
@include('common')