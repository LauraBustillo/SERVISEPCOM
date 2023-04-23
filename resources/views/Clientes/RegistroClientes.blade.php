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

/*Los botones*/ 
.btn-outline-dark {
  background-color: transparent;
  border: 1.8px solid #000000;
}

.a1 { color: aliceblue;
  outline: none;
  text-decoration: none;
  color: #000000;
  border-top:1px solid #ffffff00;  

}
a:hover{
  color:#fff;
  
  }
.a:hover{
    color: white;
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

<script>
  var errores = []
  errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!}; 
  if(errores.length > 0){
    errores.forEach(element => {
      alertify.error(element)
    });   
  }
</script>


<form class="form-control" id="form_guardarCL" name="form_guardarCL" method="POST" style="text-align: center;" onsubmit="guardarcliente()">
@csrf


{{-- Título --}}
<H1 class="titulo" >Registrar cliente</H1>
<br>



{{-- Nombre , Apellidos --}}
<div class="input-group input-group-sm mb-1" style="padding-right:6.5%"   >
  <div class="col" style="padding-left: 7% " >
    <span class="input-group-text" id="inputGroup-sizing-sm">Nombres</span> 
  <input type="text"  maxlength="25"  id="Nombre" name="Nombre"  class="form-control" 
 
   placeholder="Nombres" aria-label="First name" value="{{old('Nombre')}}">
  </div>
  <div class="col" style="padding-left:2% "  >
    <span class="input-group-text" id="inputGroup-sizing-sm">Apellidos</span> 
    <input type="text" maxlength="25" id="Apellido" name="Apellido"  
     class="form-control" 
    placeholder="Apellidos" aria-label="Last name" value="{{old('Apellido')}}">
  </div>
</div>
<br>


{{--Número de identidad, Número de teléfono --}}
<div class="input-group input-group-sm mb-1"style="padding-right:6.5%"  style="width: 100%" ><br>
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
<button  class="boton1 button button-blue" type="submit" ><i class="bi bi-folder-fill"> Guardar</i></button>
<button type="reset" class=" boton1 button button-blue"> <i class="bi bi-eraser-fill"> Limpiar</i></button>

<a    class="button button-blue" href="{{route('cliente.index')}}">
  <i class="bi bi-x-circle-fill"> Cerrar </i></a>
<br>
  <label for=""></label>
</form>



 <script>



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