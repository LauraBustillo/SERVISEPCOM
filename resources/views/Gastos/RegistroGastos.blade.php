@extends('main')
@section('extra-content')


<style>
    /*Cajas de texto*/
    .form-control {
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

    a {
        color: aliceblue;
        outline: none;
        text-decoration: none;
        color: #000000;
    }

    .a:hover {
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

{{--Mostrar funcion--}}
<script>
    var errores = []
    errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!};
    if(errores.length > 0){
      errores.forEach(element => {
        alertify.error(element)
      });
    }

  </script>

<form class="form-control" method="POST" action="{{ route('store.gasto') }}"id="form_guardarGasto" name="form_guardarGasto"  onsubmit="guardarGasto()">
    @csrf

    {{-- Título --}}
    <H1 class="titulo" style="text-align: center;">Registro  de gasto</H1>
    <br>

    <div class="input-group input-group-sm flex">
        {{-- Nombre del gasto  --}}
        <div class="col" style="width: 50%">
            <span class="input-group-text" id="inputGroup-sizing-sm">Nombre del gasto</span> 
            <input    onkeyup="app.inputKeyUpDirect(this);" type="text" name="nombre_gasto" id="nombre_gasto" class="form-control" value="{{old('nombre_gasto')}}" maxlength="25"
            placeholder="Nombre del gasto">
        </div>
        &nbsp;&nbsp;&nbsp;
         {{-- Tipo de gasto  --}}
        <div class="col" style="width: 50%">
            <span class="input-group-text" id="inputGroup-sizing-sm">Tipo de gasto</span> 
              <select class="form-select form-control"  name="tipo_gasto" id="tipo_gasto" >
                <option  value="{{null}}" id= "prueba">Seleccione el tipo de gasto</option>
                <option   value="Fijo" {{ old('tipo_gasto') == "Fijo" ? 'selected' : '' }}>Fijo</option>
                <option  value="Variable" {{ old('tipo_gasto') == "Variable" ? 'selected' : '' }}>Variable</option>
              </select>

        </div>
    </div>
    <br>

    <div class="input-group input-group-sm flex">
        {{-- Fecha del gasto --}}
        <div class="col" style="width: 50%">
            <span class="input-group-text" id="inputGroup-sizing-sm">Fecha del gasto</span> 
            <input type="date" name="fecha_gasto" id="fecha_gasto" class="form-control" value="{{$fecha_actual}}" readonly
            placeholder="Fecha del gasto">
        </div>
        &nbsp;&nbsp;&nbsp;
        {{--Descripcion --}}
     <div class="col" style="width: 50%" >
        <span class="input-group-text" id="inputGroup-sizing-sm">Descripción</span> 
          <textarea   onkeyup="app.inputKeyUpDirect(this);"  maxlength="150" name="descripcion_gasto" spellcheck="true"  id="descripcion_gasto" class="form-control" 
           rows="1" placeholder=" Descripción " >{{old('descripcion_gasto')}}</textarea>
        </div >

    </div>
    <br> 

   <div class="input-group input-group-sm flex">
    {{--Total gasto --}}
    <div class="col" style="width: 50%">
        <span class="input-group-text" id="inputGroup-sizing-sm">Total del gastos</span> 
        <input  type="text" name="total_gasto" id="total_gasto" class="form-control" value="{{old('total_gasto')}}" maxlength="5"
        placeholder="Total gasto">
    </div>
    &nbsp;&nbsp; &nbsp;
     {{-- Responsable del gasto--}}
     <div class="col" style="width: 50%">
        <span class="input-group-text" id="inputGroup-sizing-sm">Responsable del gasto</span> 
       <select name="responsable_gasto" id= "responsable_gasto"  class="form-select form-control" style="background:transparent"  >
        <option  value="" id="">Seleccione al responsable</option>
 
        @foreach ($empleados as $empleado)
            <option @if(old('responsable_gasto') == $empleado->id)
                selected
            @endif value="{{$empleado->id}}" id= "">{{ $empleado->Nombres.' '.$empleado->Apellidos }}</option>
         @endforeach

        </select>
       </div>
   </div>
    <br>


        {{--Botones --}}
        <center>
            <button class="boton1 button button-blue" type="submit"> <i class="bi bi-folder-fill" > Guardar</i></button>
            <button type="reset" class="boton1 button button-blue"> <i class="bi bi-eraser-fill"> Limpiar</i></button>
            <a class="boton1 button button-blue" href="{{route('gasto.index')}}"><i class="bi bi-x-circle-fill"> Cerrar</i></a>
        </center>
        <br>
        <label for=""></label>
    </div>
    




</form>
<script>
    var d = new Date();
    var offset = -6; // offset para la hora de Honduras en GMT
    d.setHours(d.getHours() + offset);
    document.getElementById("fecha_gasto").min = d.toISOString().split("T")[0];
    d.setMonth(d.getMonth() - 1);



 
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
</script>

@endsection
{{--mensaje de confirmacion --}}
@push('alertas')
    <script>
        function guardarGasto() {
           var formul = document.getElementById("form_guardarGasto");

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

