@extends('main')
@section('extra-content')


<style>
    /*Cajas de texto*/
    .form-control {
        background-color: transparent;
        border: 1.3px solid #000000;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 0 auto;


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

  



    * {
        box-sizing: border-box;
    }

    select {
        width: 500px;
        padding: 3px 10px;
        border: 1px solid #000000;
        border-radius: 3px;
        background-color: transparent;
        margin: 8px 0;
        display: inline-block;

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

    #viewPassword{
        cursor:pointer;
    }

    /* Este elemento debe tener "position: relative" */
div#is-relative{
  max-width: 463px;
  position: relative;
  background-color: transparent;
}

/* El icono debe ser "position: absolute"
 * Ademas le damos un "display: block" y lo posicionamos */
#icon{
  position: absolute;
  display: block;
  bottom: .5rem;
  right: 1rem;
  
  user-select: none;
  cursor: pointer;
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
    errores = {
        !!json_encode($errors - > all(), JSON_HEX_TAG) !!
    };
    if (errores.length > 0) {
        errores.forEach(element => {
            alertify.error(element)
        });
    }

</script>


<form class="form-control" style="text-align: center;" method="POST" action="{{ route('store.registroUsuarios') }}" id="form_guardarUsuario" name="form_guardarUsuario" onsubmit="guardarUsuario()">
    @csrf

    {{-- Título --}}
    <H1 class="titulo" style="text-align: center;">Registro de usuario</H1>
    <br>

   
            {{-- Nombre , Apellidos --}}
            <div class="input-group input-group-sm mb-1" style="padding-right:6.5%"   >
                <div class="col" style="padding-left: 7% " >
                    <span class="input-group-text" id="inputGroup-sizing-sm">Empleado</span> 
                    <select name="id_empleado" id= "id_empleado"  class="select form-control" style="background:transparent">
                        <option  value="" >Seleccione al responsable</option>
                
                        @foreach ($empleados as $em)
                            <option @if(old('id_empleado') == $em->id)
                                selected
                            @endif value="{{$em->id}}" >{{ $em->Nombres.' '.$em->Apellidos }}</option>
                        @endforeach
                
                        </select>
                    @error('id_empleado')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="col" style="padding-left:2% "  >
                    <span class="input-group-text" id="inputGroup-sizing-sm">Ingrese el nombre de usuario</span>
                    <input  type="text" name="name" id="nombre_usuario" class="form-control" value="{{old('name')}}" maxlength="37" placeholder="Ingrese el nombre de usuario">
                    @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <br>

            <div class="input-group input-group-sm mb-1" style="padding-right:6.5%"   >
                <div class="col" style="padding-left: 7% " >
                    <span class="input-group-text" id="inputGroup-sizing-sm">Ingrese el correo</span> 
                    <input type="email" name="email" id="nombre_usuario" class="form-control" value="{{old('email')}}" maxlength="37" placeholder="Ingrese el correo del usuario">
                    @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="col" style="padding-left:2% "  >
                    <span class="input-group-text" id="inputGroup-sizing-sm">Rol del usuario</span>
                    <select name="rol_usuario" id="rol_usuario" class="select form-control">
                        <option value="">Seleccione un rol</option>
                        @foreach (App\Http\Permiso::$roles as $rol )
                        <option @if(old('rol_usuario') == $rol)
                            selected
                            @endif value="{{ $rol}}">{{ $rol }}</option>
                        @endforeach
                    </select>
                    @error('rol_usuario')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <br>
        
            <div class="input-group input-group-sm mb-1" style="padding-right:6.5%"   >
                <div class="col" style="padding-left: 7% " >
                    <span class="input-group-text" id="inputGroup-sizing-sm">Ingrese la contraseña</span> 
                    <div id="is-relative" >
                    <input  type="password" name="password" id="contrasena" class="form-control" value="{{old('password')}}" placeholder="Ingrese la contraseña">
                    <span id="icon">
                    <a id="viewPassword"><i class="bi bi-eye-fill"></i></a></span></div>
                    @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="col" style="padding-left:2% "  >
                    <span class="input-group-text" id="inputGroup-sizing-sm">Confirmar contraseña</span>
                    <input type="password" name="password_confirmation" id="repetir_contrasena" class="form-control" placeholder="Confirme la contraseña">
                    @error('password_confirmation')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

                <br>
                {{--Botones --}}
                <center>
                    <button class="boton1 button button-blue" type="submit"> <i class="bi bi-folder-fill"> Guardar</i></button>&nbsp;
                    <button type="reset" class="boton1 button button-blue"> <i class="bi bi-eraser-fill"> Limpiar</i></button>&nbsp;
                    <a class="boton1 button button-blue" href="{{route('index.usuario')}}"><i class="bi bi-x-circle-fill"> Cerrar</i> </a></button>

                </center>
                <br>
        


</form>
<script>
let password = document.getElementById('contrasena');
let viewPassword = document.getElementById('viewPassword');
let click = false;

viewPassword.addEventListener('click', (e)=>{
  if(!click){
    password.type = 'text'
    click = true
  }else if(click){
    password.type = 'password'
    click = false
  }
}) 

onkeyup="app.inputKeyUpDirect(this);"
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
    var d = new Date();
    var offset = -6; // offset para la hora de Honduras en GMT
    d.setHours(d.getHours() + offset);
    document.getElementById("fecha_gasto").min = d.toISOString().split("T")[0];
    d.setMonth(d.getMonth() - 1);

</script>

@endsection
{{--mensaje de confirmacion --}}
@push('alertas')
<script>
    function guardarUsuario() {
        var formul = document.getElementById("form_guardarUsuario");

        Swal.fire({
            title: '¿Está seguro que desea guardar los datos?'
            , icon: 'question'
            , confirmButtonColor: '#3085d6'
            , showCancelButton: true
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Si'
            , cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                formul.submit();
            }
        })
        event.preventDefault()
    }

</script>
@endpush

@include('common')

