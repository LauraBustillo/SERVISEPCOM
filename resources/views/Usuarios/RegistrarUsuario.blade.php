@extends('main')
@section('extra-content')


<style>
    /*Cajas de texto*/
    .form-control {
        background-color: transparent;
        border: 1.3px solid #000000;
        width: 60%;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 0 auto;


    }

    /*Las label*/
    .input-group-text {
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

    a {
        color: aliceblue;
        outline: none;
        text-decoration: none;
        color: #000000;
    }

    .a:hover {
        color: white;
    }



    * {
        box-sizing: border-box;
    }

    form {
        width: 400px;
        padding: 16px;
        border-radius: 10px;
        margin: auto;
        background-color: #ccc;
    }

    form label {
        width: 350px;
        font-weight: bold;
        display: inline-block;

    }
    .label{
    
        font-size: 150%;
    }

    .input1{
        background-color: transparent;
        border: 1.3px solid #000000;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        font-size: 150%;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"]{
        width: 550px;
        padding: 3px 10px;
        border: 1px solid #000000;
        border-radius: 3px;
        background-color: transparent;
        margin: 8px 0;
        display: inline-block;
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

<br>
<br>
<form class="form-control" method="POST" action="{{ route('store.registroUsuarios') }}" id="form_guardarUsuario" name="form_guardarUsuario" onsubmit="guardarUsuario()">
    @csrf
    <br>
    <br> {{--- --}}

    {{-- Título --}}
    <H1 class="titulo" style="text-align: center;">Registro de usuario</H1>
    <br>
    <br>

    <center>

        <div style="display:flex width: 100% ">

            {{-- Empleados --}}

            <div style="width: 60%" class="input-group input-group-sm flex">
                <b><label class="label" style="text-align: left">Empleados</label></b>&nbsp;&nbsp;<br>
                <select name="id_empleado" id= "id_empleado"  class="select input1" style="background:transparent">
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

            

            <br>

            {{-- Nombre del usuario --}}
            <div style="width: 60%" class="input-group input-group-sm flex">
                <b><label class="label" style="text-align: left">Ingrese el nombre de usuario</label></b>&nbsp;&nbsp;
                <input class="input1" type="text" name="name" id="nombre_usuario" class="form-control" value="{{old('name')}}" maxlength="37" placeholder="Ingrese el nombre de usuario">
                @error('name')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <br>

            {{-- Correo del usuario --}}
            <div style="width: 60%" class="input-group input-group-sm flex">
                <b><label class="label" style="text-align: left">Ingrese el correo</label></b>&nbsp;&nbsp;
                <input class="input1"type="email" name="email" id="nombre_usuario" class="form-control" value="{{old('email')}}" maxlength="37" placeholder="Ingrese el correo del usuario">

                @error('email')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>

            <br>

            {{--contraseña--}}
            <div style="width: 60%" class="input-group input-group-sm flex">
                <b><label class="label" style="text-align: left">Ingrese la contraseña</label></b>&nbsp;&nbsp;
                <input class="input1" type="password" name="password" id="contrasena" class="form-control" value="{{old('password')}}" placeholder="Ingrese la contraseña">
                @error('password')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <br>

            {{--repetir contraseña--}}
            <div style="width: 60%" class="input-group input-group-sm flex">
                <b><label class="label" style="text-align: left">Confirmar contraseña</label></b>&nbsp;&nbsp;
                <input class="input1" type="password" name="password_confirmation" id="repetir_contrasena" class="form-control" placeholder="Confirme la contraseña">
                @error('password_confirmation')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <br>

            <div style="width: 60%" class="input-group input-group-sm flex">
                <b><label class="label" style="text-align: left">Rol</label></b>&nbsp;&nbsp;
                <select name="rol_usuario" id="rol_usuario" class="input1">
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
           
                        
                    
            <br>
            

            {{--pregunta
            <div style="width: 50%" class="input-group input-group-sm flex">
                <b><label style="text-align: left">¿Cual es tu color favorito?</label></b>&nbsp;&nbsp;
                <input type="text" name="color_favo" id="pregunta2" class="form-control" value="{{old('color_favo')}}">
            </div> --}}
            <center>
                <br><br>
                {{--Botones --}}
                <center>
                    <button class="btn btn-outline-dark btn-lg" type="submit"> <i class="bi bi-folder-fill"> Guardar</i></button>&nbsp;
                    <button type="reset" class="btn btn-outline-dark btn-lg"> <i class="bi bi-eraser-fill"> Limpiar</i></button>&nbsp;
                    <button type="button" class="btn btn-outline-dark btn-lg"><a class="a" href="{{route('index.usuario')}}"><i class="bi bi-x-circle-fill"> Cerrar</i> </a></button>

                </center>
                <br>
        </div>


</form>
<script>
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
    function guardarGasto() {
        var formul = document.getElementById("form_guardarGasto");

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

