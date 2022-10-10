
@extends('main')
@section('extra-content')
<style>

/*Los titulos */ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #000000;
  font-family: 'Open Sans';
  font-size: 20xp;
}

/*Cajas de texto*/ 
.form-control  {
    background-color: transparent;
    border: 1.3px solid #000000;
}

/*Las label*/ 
.input-group-text  {
  background-color: #000000;
  border: 1.3px solid #000000;
  font-family: 'Open Sans';
  color: #FFFFFF;

}

/*Los botones*/ 
.btn-outline-dark {
 
  background-color: transparent;
  border: 1.8px solid #000000;
}
.btn-outline-dark:hover{
    background-color: rgb(48, 48, 48);
    color: white;
}

a { color: aliceblue;
  outline: none;
  text-decoration: none;
  color: #000000;
}
.a:hover{
    background-color: rgb(48, 48, 48);
    color: white;
}


</style>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $mesaje)
                <li>{{ $mesaje }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br>
<br>

<form class="form-control" id="ablescroll" method="POST" style="text-align: center;">
@csrf
<br>

{{-- Título --}}
<H1 class="titulo"  style="font-size: 30px" >Registrar empleado</H1>
<br>
{{-- Primer nombre , Segundo nombre --}}
<div class="row g-3">
  <div class="col">
    <input type="text"   minlength="3" maxlength="25" name="Primer_nombre" id="Primer_nombre"  pattern="[A-Z a-z]+" class="form-control"  required title="Este campo solo debe de contener letras" placeholder="Primer nombre" 
    aria-label="First name" value="{{old('Primer_nombre')}}">
  </div>
  <div class="col">
    <input type="text"  name="Segundo_nombre" id="Segundo_nombre" pattern="[A-Z a-z]+" class="form-control"   placeholder="Segundo nombre" 
    aria-label="Last name" value="{{old('Primer_nombre')}}">
  </div>
</div>
<br>

{{-- Primer apellido , Segundo apellido --}}
<div class="row g-3">
  <div class="col">
    <input type="text" minlength="4" maxlength="25" name="Primer_apellido" id="Primer_apellido" pattern="[A-Z a-z]+" class="form-control"   required title="Este campo solo debe de contener letras"
     placeholder="Primer apellido" aria-label="First name" value="{{old('Primer_apellido')}}">
  </div>
  <div class="col">
    <input type="text"   name="Segundo_apellido" id="Segundo_apellido" pattern="[A-Z a-z]+"  class="form-control"   
    placeholder="Segundo apellido" aria-label="Last name" value="{{old('Segundo_apellido')}}">
  </div>
</div>
<br>

{{-- Número de identidad--}}
<div class="input-group input-group-sm mb-1" style="padding-right:4%"  style="width: 150%" ><br>
<div class="col" style="padding-left: 7%"  >
  <span class="input-group-text" id="inputGroup-sizing-sm">Número de identidad</span> 
  <input type="text" readonly  minlength="13"  maxlength="13" name="Numero_identidad" id="Numero_identidad"  class="form-control"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"   required title="En este campo se debe comenzar con 0 o 1. Debe contener 13 caracteres y solo numeros" 
   pattern="([0-1][0-8][0-2][0-9]{10})" pattern="[0-9]+"  placeholder="Eje. 0000000000000" value="{{old('Numero_identidad')}}">
  </div> 

  {{-- Fecha de nacimiento --}}
  <div class="col" style="padding-left: 4%" > 
  <span class="input-group-text" id="inputGroup-sizing-sm">Fecha de nacimiento</span>
  <input type="date" readonly  name="Fecha_nacimiento" id="Fecha_nacimiento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" 
  required  placeholder="Fecha de nacimiento" value="{{old('Fecha_nacimiento')}}">
</div>

{{-- Número de teléfono --}}
<div class="col"style="padding-left: 4%"> 
  <span class="input-group-text"  id="inputGroup-sizing-sm">Número de teléfono</span>
  <input type="text"  minlength="8" maxlength="8" name="Numero_telefono" id="Numero_telefono" class="form-control" aria-label="Sizing example input"
   aria-describedby="inputGroup-sizing-sm" required title="Este campo solo debe contener numeros"  pattern="([9,8,3]{1}[0-9]{7})" pattern="[0-9]+" 
    placeholder="Eje. 00000000" value="{{old('Numero_telefono')}}">
</div>
</div>
<br>

{{-- Fecha de contrato, Salario --}}
<div class="input-group">
  <span class="input-group-text">Fecha de contrato</span>
  <input type="date"  name="Fecha_contrato" id="Fecha_contrato" aria-label="First name" class="form-control" require  placeholder="Fecha de contrato" value="{{old('Fecha_nacimiento')}}">
  <input type="text" minlength="3" maxlength="6" name="Salrio" id="Salrio"   aria-label="Last name" class="form-control"  required   title="Este campo solo debe contener numeros"   pattern="[0-9]+"  placeholder=" Salario Lps." value="{{old('Salrio')}}">
</div>
<br>
{{-- Dirección --}}
<div class="mb-3" style="padding-left: 22%">
  <textarea class="form-control" spellcheck="true"
   minlength="10" maxlength="150" name="Direccion" id="Direccion" style="width: 70%"  id="exampleFormControlTextarea1" rows="3" required placeholder="Ingrese la dirección exacta de su domicilio"
  value="{{old('Direccion')}}" ></textarea>
</div>

{{--Botones --}}

<button  class="btn btn-outline-dark" type="submit" ><i class="bi bi-folder-fill"> Guardar</i></button>
<button type="reset" class="btn btn-outline-dark"> <i class="bi bi-eraser-fill"> Limpiar</i></button>
<button type="button" class="btn btn-outline-dark">
  <a class="a"  href="{{route('empleado.index')}}"><i class="bi bi-x-circle-fill"> Cerrar </i></a></button>
</form>


@endsection
@include('common')