
@extends('main')
@section('extra-content')
<style>

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
  color: #4c4d4e; 
  font-family: 'Open Sans';
  font-size: 20xp;
}

/*Cajas de texto*/
.form-control  {
    background-color: transparent;
    border: 1.3px solid #000000;
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

<script>
  var errores = []
  errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!};
  if(errores.length > 0){
    errores.forEach(element => {
      alertify.error(element)
    });
  }
</script>


<form class="form-control" id="form_guardarE" name="form_guardarE"  method="POST" style="text-align: center;" onsubmit="confirmar()">
@csrf
<br>

{{-- Título --}}
<H1 class="titulo">Registrar empleado</H1>
<br>

{{-- Nombres y Apellido --}}
<div class="row g-3">
  <div class="col">
    <span class="input-group-text" id="inputGroup-sizing-sm">Nombres</span> 
    <input type="text" maxlength="25" name="Nombres" id="Nombres"  class="form-control"
    placeholder="Nombres" aria-label="First name" value="{{old('Nombres')}}"  onkeyup="app.inputKeyUpDirect(this);">
  </div>

  <div class="col">
        <span class="input-group-text" id="inputGroup-sizing-sm">Apellidos</span> 
    <input type="text"  maxlength="25" name="Apellidos" id="Apellidos" class="form-control"
     placeholder="Apellidos" aria-label="First name" value="{{old('Apellidos')}}"  onkeyup="app.inputKeyUpDirect(this);">
  </div>

</div>
<br>

{{-- Número de identidad--}}
<div class="row  input-group input-group-sm mb-1" style="padding-right:4%" ><br>
<div class="col" style="padding-left: 7%"  >
  <span class="input-group-text" id="inputGroup-sizing-sm">Número de identidad</span>
  <input type="text"   maxlength="13" name="Numero_identidad" id="Numero_identidad"  class="form-control"  
  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
   placeholder="Eje. 0000000000000" value="{{old('Numero_identidad')}}">
  </div>

  {{-- Fecha de nacimiento --}}
  <div class="col" style="padding-left: 4%" >
  <span class="input-group-text" id="inputGroup-sizing-sm">Fecha de nacimiento</span>
  <input type="date"  name="Fecha_nacimiento" id="Fecha_nacimiento"  max="2004-01-01" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
  placeholder="Fecha de nacimiento" value="{{old('Fecha_nacimiento')}}">
</div>

{{-- Número de teléfono --}}
<div class="col"style="padding-left: 4%">
  <span class="input-group-text"  id="inputGroup-sizing-sm">Número de teléfono</span>
  <input type="text"  maxlength="8" name="Numero_telefono" id="Numero_telefono" class="form-control" aria-label="Sizing example input"
   aria-describedby="inputGroup-sizing-sm" placeholder="Eje. 00000000" value="{{old('Numero_telefono')}}">
</div>
</div>
<br>

{{-- Fecha de contrato, Salario --}}
<div class="input-group">
  <span class="input-group-text">Fecha de contrato</span>
  <input type="date"  name="Fecha_contrato" id="fechaActual"  aria-label="First name" class="form-control"   placeholder="Fecha de contrato" value="{{old('Fecha_nacimiento')}}"  max= "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 months"));?>"   date_default_timezone_set(); >
  &nbsp;&nbsp;<span class="input-group-text">Salario</span>
  <input type="number" min="5000" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" name="Salrio" id="Salrio"   aria-label="Last name" class="form-control"  placeholder=" Salario Lps." value="{{old('Salrio')}}">
</div>


<br>
{{-- Dirección --}}
<div class="mb-3" style="padding-left: 22%">
<span class="input-group-text"  style="width: 70%">Dirección</span>
  <textarea class="form-control" spellcheck="true"
  maxlength="150" name="Direccion" id="Direccion" style="width: 70%"  id="exampleFormControlTextarea1" rows="3"
   placeholder="Ingrese la dirección exacta del domicilio"  onkeyup="app.inputKeyUpDirect(this);">{{old('Direccion')}}</textarea>
</div>

{{--Botones --}}

<button  class="boton1 button button-blue" type="submit" ><i class="bi bi-folder-fill"> Guardar</i></button>
<button type="reset" class="boton1 button button-blue"> <i class="bi bi-eraser-fill"> Limpiar</i></button>

  <a    class="button button-blue" href="{{route('empleado.index')}}">
    <i class="bi bi-x-circle-fill"> Cerrar </i></a>

    <br>
    <label for=""></label>
</form>

<script>

/* Para poner en mayuscula la primer letra*/
var app = app || {};
        
        app.toCapitalizeWords = function(text){
            return text.replace(/\w\S*/g, function(txt){
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
        }

        app.inputKeyUp = function(e){
            var value = e.target.value;
            e.target.value = app.toCapitalizeWords(value);
        }

        app.inputKeyUpDirect = function(input){
            input.value = app.toCapitalizeWords(input.value);
        }

        var inputsToCapitalizeWordsCollection = document.getElementsByClassName("toCapitalizeWords");

        for (let i = 0; i < inputsToCapitalizeWordsCollection.length; i++) {
            const element = inputsToCapitalizeWordsCollection[i];
            element.addEventListener("keyup", app.inputKeyUp);
            
        }

  //Funcion para establecer fecha actual en la fecha de contrato
    window.onload = function(){
    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth()+1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('fechaActual').value= ano+"-"+mes+"-"+dia;
  }


  </script>

@endsection
{{--mensaje de confirmacion --}}
@push('alertas')
    <script>
        function confirmar() {
           var formul = document.getElementById("form_guardarE");

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
