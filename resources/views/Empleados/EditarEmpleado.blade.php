@extends('main')
@section('extra-content')

<style>

/*Los titulos de las letras*/ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #000000;
  font-family: 'Open Sans';
  font-size: 20xp;
}

/*Las Cajas de texto*/ 
.form-control  {
    background-color: transparent;
    border: 1.3px solid #000000;
}

/*Las etiquetas label*/ 
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
<br><br>

{{-- Mensaje de editar (error)--}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $mesaje)
                <li>{{ $mesaje }}</li>
            @endforeach
        </ul>
    </div>
@endif 

<form class="form-control" id="form_editarE" name="form_editarE" method="POST" style="text-align: center;" onsubmit="confirmar()">
@method('put')
@csrf
<br>

{{-- Título --}}
<H1 class="titulo"  style="font-size: 30px" >Editar empleado</H1>
<br>
<br>

{{-- Nombres y Apellidos--}}

<div class="row g-3">
  <div class="col">

    <input type="text"   minlength="3" maxlength="25" name="Nombres" id="Nombres" pattern="[A-ZÑ a-zñ]+"
     class="form-control" name="Nombres"  title="Solo debe de tener letras"
      required placeholder="Nombres" aria-label="First name" 
    Value="{{old('Nombres', $modificar->Nombres)}}">
  </div>
  <div class="col">
    <input type="text" minlength="4" maxlength="25" name="Apellidos" 
    id="Apellidos"  pattern="[A-ZÑ a-zñ]+" class="form-control"   required 
     title="Solo debe de tener letras" required placeholder="Apellidos"  aria-label="First name"
    Value="{{old('Apellidos',$modificar->Apellidos)}}">

  </div>
</div>
<br>

{{-- Número de identidad --}}
<div class="input-group input-group-sm mb-1" style="padding-right:4%"  style="width: 150%" ><br>
<div class="col" style="padding-left: 7%"  >
  <span class="input-group-text" id="inputGroup-sizing-sm">Número de identidad</span> 
  <input type="text"   minlength="13" maxlength="13" name="Numero_identidad" id="Numero_identidad"
   class="form-control"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
    required title="Debe comenzar con 0 o 1. Debe contener 13 caracteres y solo números" pattern="([0-1][0-8][0-2][0-9]{10})" pattern="[0-9]+"  placeholder="Eje. 0000000000000"
  Value="{{old('Numero_identidad',$modificar->Numero_identidad)}}">
  </div> 

  {{-- Fecha de nacimiento--}}
  <div class="col" style="padding-left: 4%" > 
  <span class="input-group-text" id="inputGroup-sizing-sm">Fecha de nacimiento</span>
  <input type="date"   name="Fecha_nacimiento" id="Fecha_nacimiento" class="form-control" 
   name="Fecha_nacimiento" id="Fecha_nacimiento" aria-label="Sizing example input" 
   aria-describedby="inputGroup-sizing-sm" placeholder="Fecha de nacimiento"
  Value="{{old('Fecha_nacimiento',$modificar->Fecha_nacimiento)}}">
</div>


{{-- Numero de teléfono --}}
<div class="col"style="padding-left: 4%"> 
  <span class="input-group-text"  id="inputGroup-sizing-sm">Número de teléfono</span>
  <input type="text" minlength="8" maxlength="8" name="Numero_telefono" id="Numero_telefono"  class="form-control"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required
   title="Primer digito (2, 3, 8 o 9) y solo debe  números." 
    pattern="([9,8,3,2]{1}[0-9]{7})"  pattern="[0-9]+"  placeholder="Eje. 00000000"
  Value="{{old('Numero_telefono',$modificar->Numero_telefono)}}">
</div>
</div>
<br>

{{-- Fecha de contrato,Salario --}}
<div class="input-group">
  <span class="input-group-text">Fecha de contrato</span>
  <input type="date" aria-label="First name" class="form-control"  name="Fecha_contrato" id="Fecha_contrato" 
  placeholder="Fecha de contrato"  Value="{{$modificar->Fecha_contrato}}" max= "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 months"));?>"   date_default_timezone_set();>
  <input type="number" min="5000" minlength="3" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" name="Salrio" id="Salrio" aria-label="Last name" class="form-control"  name="Salrio" id="Salrio"  required  title="Este campo solo debe contener numeros"  pattern="[0-9]+" 
   placeholder=" Salario Lps."  Value="{{old('Salario',$modificar->Salrio)}}">
</div>
<br>

{{-- Dirección --}}
<div class="mb-3" style="padding-left: 22%">
  <textarea class="form-control" minlength="10" maxlength="150" name="Direccion" id="Direccion" style="width: 70%"  id="exampleFormControlTextarea1" rows="3" required placeholder="Ingrese la dirección exacta de su domicilio" 
 >{{old('Direccion',$modificar->Direccion)}}</textarea>
</div>


{{--Botones --}}
<button type="submit" class="btn btn-outline-dark" ><i class="bi bi-repeat" > Actualizar</i></button>
<button type="reset" class="btn btn-outline-dark"><i class="bi bi-arrow-counterclockwise"> Restaurar</i></button>
<button type="button" class="btn btn-outline-dark">
  <a class="a"  href="{{route('empleado.index')}}"><i class="bi bi-x-circle"> Cancelar </i> </a></button>
<br>
</form>

@endsection
{{--mensaje de confirmacion --}}
@push('alertas')
    <script>
        function confirmar() {
           var formul = document.getElementById("form_editarE");
           
           Swal.fire({
                title: '¿Está seguro que desea guardar los cambios?',
                icon: 'question',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then((result)=>{
                if (result.isConfirmed) {
                    formul.submit();
                }
            })
            event.preventDefault()
        }
    </script>
@endpush

@include('common')