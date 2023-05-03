@extends('main')
@section('extra-content')
<style>

/*Cajas de texto*/ 
.form-control  {
    background-color: transparent;
    border: 1.3px solid #000000;
} 

div.container {

width: 100% !important;
height: 100% !important;
padding-left: 10% !important;
}
 
/*Los titulos de las letras*/ 
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

/*El boton cancelar */ 
a { color: aliceblue;
  outline: none;
  text-decoration: none;
  color: #000000;
}
.a:hover{
    
    color: white;
}

.ancho-alto {
        width: 109%;
        height: 31%;
        resize: none;
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

<br>
<script>
    var errores = []
    errores = {!! json_encode($errors->all(), JSON_HEX_TAG) !!}; 
    if(errores.length > 0){
      errores.forEach(element => {
        alertify.error(element)
      });   
    }
  </script>






<form class="form-control" id="form_editarP" name="form_editarP"  method="POST" style="text-align: center;" onsubmit="confirmar()" >
@method('put')
@csrf

<br>
<br>
{{-- Título --}}
<H1 class="titulo"  style="font-size: 30px" >Editar proveedor</H1>
<br>
<br>

{{-- Nombre de la empresa --}}

            <div class="row g-3" class="input-group input-group-sm mb-1" >
              <div class="col">
            

              <span class="input-group-text" id="inputGroup-sizing-sm">Nombre de la empresa</span>

                <input type="text"   maxlength="25" name="Nombre_empresa" id="Nombre_empresa"    onkeyup="app.inputKeyUpDirect(this);"
                class="form-control"  placeholder="Nombre de la empresa" 
                aria-label="First name" value="{{old('Nombre_empresa', $modificar->Nombre_empresa)}}" >
              </div>
              <div class="col">
              <span class="input-group-text" id="inputGroup-sizing-sm">Correo de la empresa</span>

                <input type="text" maxlength="25" name="Correo" id="Correo"  class="form-control" 
                 pattern="[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?"
                 placeholder="Ingrese el correo electrónico" aria-label="gmail" value="{{old('Correo',$modificar->Correo)}}">
              </div>
            </div>
            <br> 

            {{-- Número de teléfono de la empresa --}}
            <div class="input-group input-group-sm mb-1" style="padding-right:4%"  style="width: 150%" ><br>
                <div class="col"  >
                    <span class="input-group-text" style="width: 109%"  id="inputGroup-sizing-sm">Teléfono de la empresa</span>
                    <input type="text" style="width: 109%" maxlength="8" name="Telefono_empresa" id="Telefono_empresa" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm"  placeholder="Eje. 00000000" value="{{old('Telefono_empresa', $modificar->Telefono_empresa)}}">   
                </div> 
                
                {{-- Direccion --}}
                <div class="col" style="padding-left: 6%" > 
                    <span class="input-group-text"  style="width: 109%">Dirección </span>
                    <textarea class="form-control ancho-alto" spellcheck="true" maxlength="150"   onkeyup="app.inputKeyUpDirect(this);"
                    name="Direccion" id="Direccion" id="exampleFormControlTextarea1" placeholder="Ingrese la dirección exacta de la empresa">{{old('Direccion',$modificar->Direccion)}}</textarea>
                </div>
                </div>

                {{-- Nombres y Apellidos del encargado--}}
            <div class="row g-3">
                <div class="col">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nombres del encargado</span>

                <input type="text"  maxlength="25" name="Nombre_encargado" id="Nombre_encargado" class="form-control"   onkeyup="app.inputKeyUpDirect(this);"
                placeholder="Nombres del encargado" aria-label="First name" value="{{old('Nombre_encargado', $modificar->Nombre_encargado)}}">
                </div>

                <div class="col">
                <span class="input-group-text" id="inputGroup-sizing-sm">Apellidos del encargado</span>

                <input type="text" maxlength="25" name="Apellido_encargado" id="Apellido_encargado"  onkeyup="app.inputKeyUpDirect(this);"
                class="form-control" placeholder="Apellidos del encargado" aria-label="last name" 
                value="{{old('Apellido_encargado',$modificar->Apellido_encargado)}}">
                </div>
            </div>
            <br>
            {{-- Número de teléfono del encargado--}}
            
            <div class="col" style="padding-left:27%" > 
                <span class="input-group-text" style="width: 60%"  id="inputGroup-sizing-sm">Teléfono del encargado</span>
                <input type="text" style="width: 60%"  maxlength="8" name="Telefono_encargado" id="Telefono_encargado"
                 class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm" placeholder="Eje. 00000000" value="{{old('Telefono_encargado',$modificar->Telefono_encargado)}}">
            </div>

            <br>
                {{--Botones --}}
                <div class="col" >
                <button class="button button-blue " type="submit" ><i class="bi bi-repeat" > Actualizar</i></button>
                <button type="reset" class="button button-blue "><i class="bi bi-arrow-counterclockwise"> Restaurar</i></button>
               
                <a class="button button-blue " href="{{route('proveedor.index')}}"><i class="bi bi-x-circle"> Cancelar </i></a>
                </div>

                <label for=""></label>
                <br>
            
            <br>
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
</script>
@endsection 

{{--mensaje de confirmacion --}}
@push('alertas')
    <script>
        function confirmar() {
           var formul = document.getElementById("form_editarP");
           
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