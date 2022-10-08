@extends('main')
@section('extra-content')

<style>

/*Cajas de texto*/ 
.form-control  {
    background-color: transparent;
    border: 1.3px solid #000000;
}

/*Las equitetas label*/ 
.input-group-text  {
  background-color: #000000;
  border: 1.3px solid #000000;
  font-family: 'Open Sans';
  color: #FFFFFF;

}

/*Los titulos de las letras*/ 
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

/*El boton cancelar */ 
a { color: aliceblue;
  outline: none;
  text-decoration: none;
  color: #000000;
}
.a:hover{
    
    color: white;
}



</style>
<form class="form-control" id="Editar" name="Editar"  method="POST" style="text-align: center;" >
@method('put')
@csrf

<br>
<br>
{{-- Título --}}
<H1 class="titulo"  style="font-size: 30px" >Editar Cliente</H1>
<br>
<br>

{{-- Nombre , Apellido --}}
<div class="row g-3">
    <div class="col">
    <input type="text" minlength="3" maxlength="25"  id="Nombre" name="Nombre" pattern="[A-Za-z]+" required title="Este campo solo debe de contener letras" class="form-control" id="Nombre" name="Nombre" aria-label="First name" 
    Value="{{$modificar->Nombre}}">
</div>

<div class="col">
    <input type="text" minlength="4" maxlength="25" id="Apellido" name="Apellido" pattern="[A-Za-z]+" required title="Este campo solo debe de contener letras" class="form-control"  aria-label="Last name"
    Value="{{$modificar->Apellido}}">
    </div>
</div>
<br>

<br>

{{--Número de identidad, Número de teléfono --}}
<div class="input-group input-group-sm mb-1" style="padding-right:6.5%"  style="width: 150%" ><br>
<div class="col" style="padding-left: 7%">

  <span class="input-group-text" id="inputGroup-sizing-sm">Número de identidad</span> 
  <input type="text" minlength="13" maxlength="13" name="Numero_identidad" id="Numero_identidad" class="form-control"  name="Numero_identidad" id="Numero_identidad" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required title="En este campo se debe comenzar con 0 o 1. Debe contener 13 caracteres" pattern="([0-1][0-8][0-2][0-9]{10})" pattern="[0-9]+"  placeholder="Eje. 0000000000000" placeholder="Eje. 0000-0000-00000"
  Value="{{$modificar->Numero_identidad}}">
</div> 

<div class="col" style="padding-left:2%"  > 
  <span class="input-group-text" id="inputGroup-sizing-sm">Número de teléfono</span>
  <input type="text" minlength="8" maxlength="8" name="Numero_telefono" id="Numero_telefono" class="form-control" name="Numero_telefono" id="Numero_telefono" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required  title="Este campo solo debe contener numeros"  pattern="([9,8,3]{1}[0-9]{7})" pattern="[0-9]+"  placeholder="Eje. 0000-0000"
  Value="{{$modificar->Numero_telefono}}">
</div>
</div>
<br>

{{--Dirección --}}
<div class="mb-3" style="padding-left: 22%">
  <textarea class="form-control" minlength="10" maxlength="150"  name="Direccion"  id="Direccion" style="width: 70%" id="exampleFormControlTextarea1" rows="3" placeholder="Dirección exacta">
  {{$modificar->Direccion}} </textarea>
</div>

{{--Botones --}}
<button type="submit" class="btn btn-outline-dark" name="Modal1" id="Modal1"><i class="bi bi-repeat" > Actualizar</i></button>
<button type="reset" class="btn btn-outline-dark"><i class="bi bi-arrow-counterclockwise"> Restaurar</i></button>
<button type="button" class="btn btn-outline-dark">
 
<a class="a"  href="{{route('cliente.index')}}"><i class="bi bi-x-circle"> Cancelar </i> </a></button>

<br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>

@endsection 
@include('common')