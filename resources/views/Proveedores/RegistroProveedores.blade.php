@extends('main')
@section('extra-content')

<style>

    /*Los titulos */ 
    .titulo {
      font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
      color: #000000;
      font-family: 'Open Sans';
      font-size: 20xp;
    }
    
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
        width: 109%;
        height: 31%;
        resize: none;
    }
    </style>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $mesaje)
                    <li>{{ $mesaje }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <br>
        <br>
    
    <form class="form-control" id="form_guardarP" name="form_guardarP"  method="POST" style="text-align: center;" onsubmit="confirmar()">
            @csrf
            <br><br>
            
            {{-- Título --}}
            <H1 class="titulo"  style="font-size: 30px" >Registrar proveedor</H1>
            <br>
            
            {{-- Nombre de la empresa --}}
            <div class="row g-3" class="input-group input-group-sm mb-1" >
              <div class="col">
            
                <input type="text"   minlength="3" maxlength="25" name="Nombre_empresa" id="Nombre_empresa"  pattern="[A-ZÑ a-zñ]+" class="form-control"  required title="Solo debe tener letras" placeholder="Nombre de la empresa" 
                aria-label="First name" value="{{old('Nombre_empresa')}}">
              </div>
              <div class="col">
                <input type="text" minlength="4" maxlength="25" name="Correo" id="Correo"  class="form-control"   required pattern="[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?"

                 placeholder="Ingrese el correo electronico" aria-label="gmail" value="{{old('Correo')}}">
              </div>
            </div>
            <br> 

            
            {{-- Número de teléfono de la empresa --}}
            <div class="input-group input-group-sm mb-1" style="padding-right:4%"  style="width: 150%" ><br>
                <div class="col"  >
                    <span class="input-group-text" style="width: 109%"  id="inputGroup-sizing-sm">Teléfono de la empresa</span>
                    <input type="text" style="width: 109%"  minlength="8" maxlength="8" name="Telefono_empresa" id="Telefono_empresa" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm" required title="Primer digito (2, 3, 8 o 9) y solo debe tener números."  pattern="([9,8,3,2]{1}[0-9]{7})" pattern="[0-9]+" 
                    placeholder="Eje. 00000000" value="{{old('Telefono_empresa')}}">
                </div> 
                
                {{-- Direccion --}}
                <div class="col" style="padding-left: 6%" > 
                    <span class="input-group-text"  style="width: 109%">Dirección</span>
                    <textarea class="form-control ancho-alto" spellcheck="true" 
                    minlength="10" maxlength="150" name="Direccion" id="Direccion" id="exampleFormControlTextarea1" 
                     required placeholder="Ingrese la dirección exacta de la empresa">{{old('Direccio')}}</textarea>
                </div>
                </div>
            {{-- Nombres y Apellidos del encargado--}}
            <div class="row g-3">
                <div class="col">
                <input type="text"   minlength="3" maxlength="25" name="Nombre_encargado" id="Nombre_encargado"  pattern="[A-ZÑ a-zñ]+" class="form-control"  
                required title="Solo debe de tener letras" placeholder="Nombres del encargado" 
                aria-label="First name" value="{{old('Nombre_encargado')}}">
                </div>

                <div class="col">
                <input type="text" minlength="4" maxlength="25" name="Apellido_encargado" id="Apellido_encargado" pattern="[A-ZÑ a-zñ]+" class="form-control"  
                 required title="Solo debe tener letras"
                placeholder="Apellidos del encargado" aria-label="last name" value="{{old('Apellido_encargado')}}">
                </div>
            </div>
            <br>
            
            {{-- Número de teléfono del encargado--}}
            
            <div class="col" style="padding-left:27%" > 
                <span class="input-group-text" style="width: 60%"  id="inputGroup-sizing-sm">Teléfono del encargado</span>
                <input type="text" style="width: 60%"   minlength="8" maxlength="8" name="Telefono_encargado" id="Telefono_encargado" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm" required title="Primer digito (2, 3, 8 o 9) y solo debe tener números."  pattern="([9,8,3,2]{1}[0-9]{7})" pattern="[0-9]+" 
                placeholder="Eje. 00000000" value="{{old('Telefono_encargado')}}">
            </div>
                <br>
                {{--Botones --}}
                <div class="col" >
                <button  class="btn btn-outline-dark" type="submit" ><i class="bi bi-folder-fill"> Guardar</i></button>
                <button type="reset" class="btn btn-outline-dark"> <i class="bi bi-eraser-fill"> Limpiar</i></button>
                <button type="button" class="btn btn-outline-dark">
                <a class="a"  href="{{route('proveedor.index')}}"><i class="bi bi-x-circle-fill"> Cerrar </i></a></button>
                </div>
            
            <br>
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