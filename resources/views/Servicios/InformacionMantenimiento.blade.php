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
</style>
 

<h1 class="titulo1">Información del matenimiento</h1>
<br>
<div>    
    <div class="titulo" >Mantenimiento: {{ $detalle->Nombre }} {{$detalle->Apellido}}</div>
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
                <td>{{$detalle->descripcionm}}</td>
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
  <a class="button button-blue "  href="{{route('mantenimiento.mostrar' , ['id' => $detalle->id]) }}"> <i class="bi bi-pen-fill"> Editar </i></a>
  <a class="button button-blue " href="{{route('mantenimiento.index')}}" ><i class="bi bi-arrow-left-circle-fill"> Volver </i></a>
  
@endsection
@include('common')