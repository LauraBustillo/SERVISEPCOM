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

<form class="form-control" id="form_editarC" name="form_editarC"  method="POST" style="text-align: center;" onsubmit="confirmar()" >
@method('put')
@csrf

<br>
<br>
{{-- Título --}}
<H1 class="titulo"  style="font-size: 30px" >Editar cliente</H1>
<br>
<br>

{{-- Nombre , Apellido --}}


<div class="input-group input-group-sm mb-1" style="padding-right:6.5%"   >
  <div class="col" style="padding-left: 7% " >
    <span class="input-group-text" id="inputGroup-sizing-sm">Nombres</span> 
  <input type="text"  maxlength="25"  id="Nombre" name="Nombre"  class="form-control" 
 
   placeholder="Nombres" aria-label="First name" value="{{old('Nombre',$modificar->Nombre)}}">
  </div>
  <div class="col" style="padding-left:2% "  >
    <span class="input-group-text" id="inputGroup-sizing-sm">Apellidos</span> 
    <input type="text" maxlength="25" id="Apellido" name="Apellido"  
     class="form-control" 
    placeholder="Apellidos" aria-label="Last name" Value="{{old('Apellido',$modificar->Apellido)}}">
  </div>
</div>
<br>

{{--Número de identidad, Número de teléfono --}}
<div class="input-group input-group-sm mb-1" style="padding-right:6.5%"  style="width: 150%" ><br>
<div class="col" style="padding-left: 7%">

  <span class="input-group-text" id="inputGroup-sizing-sm">Número de identidad</span> 
  <input type="text" minlength="13" maxlength="13" name="Numero_identidad" id="Numero_identidad" 
  class="form-control"  name="Numero_identidad" id="Numero_identidad" aria-label="Sizing example input" 
  aria-describedby="inputGroup-sizing-sm"   placeholder="Eje. 0000000000000" 
  Value="{{old('Numero_identidad', $modificar->Numero_identidad)}}">
</div> 

<div class="col" style="padding-left:2%"  > 
  <span class="input-group-text" id="inputGroup-sizing-sm">Teléfono fijo o celular</span>
  <input type="text" minlength="8" maxlength="8" name="Numero_telefono" 
  id="Numero_telefono" class="form-control" name="Numero_telefono" 
  id="Numero_telefono" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
  placeholder="Eje. 00000000"
  Value="{{old('Numero_telefono',$modificar->Numero_telefono)}}">
</div>
</div>
<br>

{{--Dirección --}}
<div class="mb-3" style="padding-left: 22%">
  <span class="input-group-text"  style="width: 70%">Dirección</span>
  <textarea class="form-control" minlength="10" maxlength="150"  name="Direccion"  id="Direccion"
   style="width: 70%" id="exampleFormControlTextarea1" rows="3" placeholder="Ingrese la dirección exacta del domicilio">
  {{old('Direccion',$modificar->Direccion)}} </textarea>
</div>

{{--Botones --}}
<div class="btn-group" role="group" aria-label="Basic outlined example">
<button type="submit" class="button button-blue " name="Modal1" id="Modal1"><i class="bi bi-repeat" > Actualizar</i></button>
<button type="reset" class="button button-blue "><i class="bi bi-arrow-counterclockwise"> Restaurar</i></button>
<a class="button button-blue " href="{{route('cliente.index')}}"><i class="bi bi-x-circle"> Cancelar </i> </a>
</div>
<br>
<label for=""></label>
</form>

@endsection 
{{--mensaje de confirmacion --}}
@push('alertas')
    <script>
        function confirmar() {
           var formul = document.getElementById("form_editarC");
           
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