@extends('main')
@section('extra-content')

<style>

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
/*Los titulos */ 
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

a { color: aliceblue;
  outline: none;
  text-decoration: none;
  color: #000000;
}
.a:hover{
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
<form class="form-control" id="form_guardarC" name="form_guardarC" method="POST" style="text-align: center;" onsubmit="confirmar()">
@csrf
<br>
<br>

{{-- Título --}}
<H1 class="titulo" >Registrar cliente</H1>
<br>
<br>

{{-- Nombre , Apellidos --}}
<div class="row g-3">
  <div class="col">
  <input type="text" minlength="3" maxlength="25"  id="Nombre" name="Nombre" pattern="[A-Z a-z]+" class="form-control" 
   required title="Este campo solo debe de contener letras" 
   placeholder="Nombres" aria-label="First name" value="{{old('Nombre')}}">
  </div>
  <div class="col">
    <input type="text" minlength="4" maxlength="25" id="Apellido" name="Apellido"  
    pattern="[A-Z a-z]+" class="form-control" required title="Este campo solo debe de contener letras" 
    placeholder="Apellidos" aria-label="Last name" value="{{old('Apellido')}}">
  </div>
</div>
<br>
<br>

{{--Número de identidad, Número de teléfono --}}
<div class="input-group input-group-sm mb-1"style="padding-right:6.5%"  style="width: 150%" ><br>
<div class="col" style="padding-left: 7%"  >
  <span class="input-group-text" id="inputGroup-sizing-sm">Número de identidad</span> 
  <input type="text"  minlength="13" maxlength="13" name="Numero_identidad" id="Numero_identidad" class="form-control"   aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required 
  title="En este campo se debe comenzar con 0 o 1. Debe contener 13 caracteres" pattern="([0-1][0-8][0-2][0-9]{10})"  pattern="[0-9]+" 
   placeholder="Eje. 0000000000000" value="{{old('Numero_identidad')}}">
  
</div> 
  <div class="col" style="padding-left:2%"  > 
  <span class="input-group-text" id="inputGroup-sizing-sm">Número de teléfono</span>
  <input type="text"  minlength="8" maxlength="8" name="Numero_telefono" id="Numero_telefono" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  required 
  title="Primer digito (3, 8 o 9) y solo debe contener números."   pattern="([9,8,3]{1}[0-9]{7})" pattern="[0-9]+"  placeholder="Eje. 00000000" value="{{old('Numero_telefono')}}">
</div>
</div>
<br>

{{--Dirección --}}
<div class="mb-3" style="padding-left: 22%">
  <textarea minlength="10" maxlength="150"  name="Direccion" spellcheck="true"  id="Direccion" class="form-control" style="width: 70%"  id="exampleFormControlTextarea1"
   rows="3" required  placeholder="Ingrese la dirección exacta de su domicilio" value="{{old('Direccion')}}" ></textarea>
</div>

{{--Botones --}}
<button   class="btn btn-outline-dark"  type="submit" ><i class="bi bi-folder-fill"> Guardar</i></button>
<button type="reset" class="btn btn-outline-dark"> <i class="bi bi-eraser-fill"> Limpiar</i></button>
<button type="button" class="btn btn-outline-dark">
<a class="a"  href="{{route('cliente.index')}}"><i class="bi bi-x-circle-fill"> Cerrar</i> </a></button>
</form>

@endsection
{{--mensaje de confirmacion --}}
@push('alertas')
    <script>
        function confirmar() {
           var formul = document.getElementById("form_guardarC");
           
           Swal.fire({
                title: '¿Está seguro que desea guardar los datos?',
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