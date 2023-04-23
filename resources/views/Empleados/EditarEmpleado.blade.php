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

 /* De  Aqui*/ 
/*Las label*/ 
.input-group-text  {
  background-color: #4c4d4e;;
  border: 1.3px solid #4c4d4e;;
  font-family: 'Open Sans';
  color: #FFFFFF;

}
/*Los titulos */ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #4c4d4e;;
  
  font-family: 'Open Sans';
  font-size: 20xp;
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



/*El boton cancelar */
a { color: aliceblue;
  outline: none;
  text-decoration: none;
  color: #000000;
}
.a:hover{

    color: white;
}

input[type="checkbox"] + label {
    font-weight: bold;
    line-height: 1em;
    color: #ccc;
    cursor: pointer;
    width: 70px;
	height: 30px;

}
input[type="checkbox"]:checked + label {
    color:#1E90FF;
    width: 70px;
	height: 30px;

}


</style>
<br><br>

{{-- Mensaje de editar (error)--}}
<script>
  var errores = []
  errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!};
  if(errores.length > 0){
    errores.forEach(element => {
      alertify.error(element)
    });
  }
</script>

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
  <span class="input-group-text" id="inputGroup-sizing-sm">Nombres</span>
    <input type="text"   minlength="3" maxlength="25" name="Nombres" id="Nombres"
     class="form-control" name="Nombres"  placeholder="Nombres" aria-label="First name"
     Value="{{old('Nombres', $modificar->Nombres)}}">
  </div>
  <div class="col">
  <span class="input-group-text" id="inputGroup-sizing-sm">Apellidos</span>

    <input type="text" minlength="4" maxlength="25" name="Apellidos"
    id="Apellidos"  class="form-control" placeholder="Apellidos"  aria-label="First name"
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
    placeholder="Eje. 0000000000000"
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
  <input type="text" minlength="8" maxlength="8" name="Numero_telefono" id="Numero_telefono"  class="form-control"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
  placeholder="Eje. 00000000" Value="{{old('Numero_telefono',$modificar->Numero_telefono)}}">
</div>
</div> 
<br>

{{-- Fecha de contrato,Salario --}}
<div class="input-group">
  <span class="input-group-text">Fecha de contrato</span>
  <input type="date" aria-label="First name" class="form-control"  name="Fecha_contrato" id="Fecha_contrato"
  placeholder="Fecha de contrato"  Value="{{$modificar->Fecha_contrato}}" max= "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 months"));?>"   date_default_timezone_set();>
  
  &nbsp;&nbsp; &nbsp;
  <span class="input-group-text">Salario Lps</span>

  <input type="number" min="5000" minlength="3" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" name="Salrio" id="Salrio" aria-label="Last name" class="form-control"  name="Salrio" id="Salrio"
   placeholder=" Salario Lps."  Value="{{old('Salario',$modificar->Salrio)}}">

</div>
<br>

{{-- Dirección --}}
<div class="mb-3" style="padding-left: 22%">
  <span class="input-group-text"  style="width: 70%">Dirección</span>
  <textarea class="form-control" minlength="10" maxlength="150" name="Direccion" id="Direccion" style="width: 70%"  id="exampleFormControlTextarea1" rows="3" placeholder="Ingrese la dirección exacta del domicilio">{{old('Direccion',$modificar->Direccion)}}</textarea>
</div>

<br>
<div class="mb-3">
    <input class="form-check-input" type="checkbox" value="activo" name="activo" @if($modificar->activo)
            checked
    @endif>
    <label class="form-check-label" for="flexCheckDefault">
      Empleado activo
    </label>
</div>



{{--Botones --}}
<button type="submit" class="button button-blue " ><i class="bi bi-repeat" > Actualizar</i></button>
<button type="reset" class="button button-blue "  ><i class="bi bi-arrow-counterclockwise"> Restaurar</i></button>

  <a class="button button-blue "  href="{{route('empleado.index')}}"><i class="bi bi-x-circle"> Cancelar </i> </a>
<br>
<label for=""></label>
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
