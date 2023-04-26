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
  color: #4c4d4e;;
  
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

    .ancho-alto {
        
        height: 31%;
        resize: none;
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
        
    
    <form class="form-control" id="form_guardarP" name="form_guardarP"  method="POST" style="text-align: center;" onsubmit="confirmar()">
            @csrf
            <br>

            {{-- Título --}}
            <H1 class="titulo" >Registrar proveedor</H1>
            <br>
            
            {{-- Nombre y correo de la empresa --}}
            <div class="row g-3 input-group input-group-sm mb-1" >
              <div class="col">
                <span class="input-group-text" id="inputGroup-sizing-sm" >Nombre de la empresa</span> 
                <input type="text"   maxlength="25" name="Nombre_empresa" id="Nombre_empresa"   onkeyup="app.inputKeyUpDirect(this);" 
                class="form-control" placeholder="Nombre de la empresa" 
                aria-label="First name" value="{{old('Nombre_empresa')}}">
              </div>
              <div class="col">
                <span class="input-group-text" id="inputGroup-sizing-sm">Correo de la empresa</span> 
                <input type="text"  maxlength="25" name="Correo" id="Correo"  class="form-control"   
                 placeholder="Ejemplo: sincorreo@gmail.com" aria-label="gmail" value="{{old('Correo')}}">
              </div>
            </div>
            <br> 

            
            {{-- Número de teléfono y direccion de la empresa --}}
            <div class="row g-3 input-group input-group-sm mb-1"  ><br>
                <div class="col"  >
                    <span class="input-group-text"  id="inputGroup-sizing-sm">Teléfono de la empresa</span>
                    <input type="text"  maxlength="8" name="Telefono_empresa" id="Telefono_empresa" 
                    class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm"  
                    placeholder="Eje. 00000000" value="{{old('Telefono_empresa')}}">
                </div> 
                
                <div class="col"  > 
                    <span class="input-group-text" id="inputGroup-sizing-sm" >Dirección</span>
                    <textarea class="form-control ancho-alto" spellcheck="true"  maxlength="150"
                     name="Direccion" id="Direccion" id="exampleFormControlTextarea1" onkeyup="app.inputKeyUpDirect(this);"
                     placeholder="Ingrese la dirección exacta de la empresa">{{old('Direccion')}}</textarea>
                </div>
            </div>



            {{-- Nombres y Apellidos del encargado--}}
            <div class="row g-3 input-group input-group-sm mb-1"  >
                <div class="col">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Nombre del encargado</span> 
                <input type="text" maxlength="25" name="Nombre_encargado" id="Nombre_encargado"  class="form-control"   onkeyup="app.inputKeyUpDirect(this);"
                 placeholder="Nombres del encargado" aria-label="First name" value="{{old('Nombre_encargado')}}">
                </div>

                <div class="col">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Apellido del encargado</span> 
                <input type="text" maxlength="25" name="Apellido_encargado" id="Apellido_encargado" class="form-control"   onkeyup="app.inputKeyUpDirect(this);"
                 placeholder="Apellidos del encargado" aria-label="last name" value="{{old('Apellido_encargado')}}">
                </div>
            </div>
            <br>
            
            {{-- Número de teléfono del encargado--}}
            <div class="col" style="padding-left:27%" > 
                <span class="input-group-text" style="width: 60%"  id="inputGroup-sizing-sm">Teléfono del encargado</span>
                <input type="text" style="width: 60%"   maxlength="8" name="Telefono_encargado" id="Telefono_encargado" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm" placeholder="Eje. 00000000" value="{{old('Telefono_encargado')}}">
            </div>
                <br>
                {{--Botones --}}
                <div class="col" >
                <button  class="boton1 button button-blue" type="submit" ><i class="bi bi-folder-fill"> Guardar</i></button>
                <button type="reset" class="boton1 button button-blue"> <i class="bi bi-eraser-fill"> Limpiar</i></button>
                <a    class="button button-blue" href="{{route('proveedor.index')}}">
                  <i class="bi bi-x-circle-fill"> Cerrar </i></a>
                </div>
            
            <br>

            
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
        /*Validaciones
      function confirmar() {
      if (document.getElementById("Nombre_empresa").value == '') {
             alertify.error("El nombre de la empresa es requerido");
            return;
        }    

      if (document.getElementById("Telefono_empresa").value == '' ) {
            alertify.error("El número de teléfono es requerido");
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

       if (document.getElementById("Nombre_encargado").value == '') {
           alertify.error("El nombre del encargado es requerida");
        return;
       } 

    }*/
            </script>
    </form>        
@endsection
{{--mensaje de confirmacion --}}
@push('alertas')
    <script>
        function confirmar() {
           var formul = document.getElementById("form_guardarP");
           
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