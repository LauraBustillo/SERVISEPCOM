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

<script>
  var errores = []
  errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!}; 
  if(errores.length > 0){
    errores.forEach(element => {
      alertify.error(element)
    });   
  }
</script>



<br>
<br>
<form class="form-control" id="form_guardarCL" name="form_guardarCL" method="POST" style="text-align: center;" onsubmit="guardarcliente()">
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
  <input type="text"  maxlength="25"  id="Nombre" name="Nombre"  class="form-control" 
 
   placeholder="Nombres" aria-label="First name" value="{{old('Nombre')}}">
  </div>
  <div class="col">
    <input type="text" maxlength="25" id="Apellido" name="Apellido"  
     class="form-control" 
    placeholder="Apellidos" aria-label="Last name" value="{{old('Apellido')}}">
  </div>
</div>
<br>
<br>

{{--Número de identidad, Número de teléfono --}}
<div class="input-group input-group-sm mb-1"style="padding-right:6.5%"  style="width: 150%" ><br>
<div class="col" style="padding-left: 7%"  >
  <span class="input-group-text" id="inputGroup-sizing-sm">Número de identidad</span> 
  <input type="text" maxlength="13" name="Numero_identidad" id="Numero_identidad" class="form-control" 
    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
   placeholder="Eje. 0000000000000" value="{{old('Numero_identidad')}}">
  
</div> 
  <div class="col" style="padding-left:2%"  > 
  <span class="input-group-text" id="inputGroup-sizing-sm">Teléfono fijo o celular</span>
  <input type="text" maxlength="8" name="Numero_telefono" id="Numero_telefono" class="form-control" 
  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" 
   placeholder="Eje. 00000000" value="{{old('Numero_telefono')}}">
</div>
</div>
<br>


{{--Dirección --}}
<div class="mb-3" style="padding-left: 22%">
<span class="input-group-text"  style="width: 70%">Dirección</span>
  <textarea  maxlength="150"  name="Direccion" spellcheck="true"  id="Direccion" class="form-control" style="width: 70%"  id="exampleFormControlTextarea1"
   rows="3" placeholder="Ingrese la dirección exacta del domicilio">{{old('Direccion')}}</textarea>
</div>

{{--Botones --}}
<button   class="btn btn-outline-dark"  type="submit" ><i class="bi bi-folder-fill"> Guardar</i></button>
<button type="reset" class="btn btn-outline-dark"> <i class="bi bi-eraser-fill"> Limpiar</i></button>
<button type="button" class="btn btn-outline-dark">
<a class="a"  href="{{route('cliente.index')}}"><i class="bi bi-x-circle-fill"> Cerrar</i> </a></button>
</form>


 <script>
/*var input = document.getElementById('Nombre');
input.addEventListener('Nombre', function(evt) {
  this.setCustomValidity('');
});
input.addEventListener('invalid', function(evt) {
  // Required
  if (this.validity.valueMissing) {
    this.setCustomValidity('Por favor complete el nombre!');
  }
});*/


      /*Validaciones*/
      function confirmar() {

        //validaciones     
        if (document.getElementById("Nombre").value == '') {
                alertify.error("El nombre es requerido");
                return;
        }    
        
        if (document.getElementById("Apellido").value == '' ) {
                alertify.error("El apellido es requerido");
                return;
        } 


        if (document.getElementById("Numero_identidad").value == '') {
                alertify.error("El número de identidad es requerido");
                return;
        } 

        if (document.getElementById("Numero_telefono").value == '') {
                alertify.error("El número de teléfono es requerido");
                return;
        } 

        if (document.getElementById("Direccion").value == '') {
                alertify.error("La dirección es requerida");
                return;
        } 
        
        }



 </script>
@endsection

{{--mensaje de confirmacion --}}
@push('alertas')
    <script>
        function guardarcliente() {
           var formul = document.getElementById("form_guardarCL");
           
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