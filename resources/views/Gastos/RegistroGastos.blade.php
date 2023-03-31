@extends('main')
@section('extra-content')


<style>
    /*Cajas de texto*/
    .form-control {
        background-color: transparent;
        border: 1.3px solid #000000;
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

<br>
<br>
<form class="form-control" method="POST" action="{{ route('store.gasto') }}"id="form_guardarGasto" name="form_guardarGasto"  onsubmit="guardarGasto()">
    @csrf
    <br>
    <br> {{--- --}}

    {{-- Título --}}
    <H1 class="titulo" style="text-align: center;">Registro  de gasto</H1>
    <br>
    <br>


    <div class="input-group input-group-sm flex">
        {{-- Nombre del gasto  --}}
        <div class="col" style="width: 50%">
            <b><label  id="inputGroup-sizing-sm">Nombre del gasto </label></b>
            <input  type="text" name="nombre_gasto" id="nombre_gasto" class="form-control" value="{{old('nombre_gasto')}}" maxlength="25"
            placeholder="Nombre del gasto">
        </div>
        &nbsp;&nbsp;&nbsp;
         {{-- Tipo de gasto  --}}
        <div class="col" style="width: 50%">
            <b><label id="inputGroup-sizing-sm" >Tipo de gasto</label></b>
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
            <b><label id="inputGroup-sizing-sm" >Fecha del gasto</label></b>
            <input type="date" name="fecha_gasto" id="fecha_gasto" class="form-control" value="{{$fecha_actual}}" readonly
            placeholder="Fecha del gasto">
        </div>
        &nbsp;&nbsp;&nbsp;
        {{--Descripcion --}}
     <div class="col" style="width: 50%" >
        <b><label id="inputGroup-sizing-sm" >Descripción</label></b>
          <textarea  maxlength="150" name="descripcion_gasto" spellcheck="true"  id="descripcion_gasto" class="form-control"
           rows="1" placeholder=" Descripción " >{{old('descripcion_gasto')}}</textarea>
        </div >

    </div>



    &nbsp;&nbsp; &nbsp;
   <div class="input-group input-group-sm flex">

    {{--Total gasto --}}
    <div class="col" style="width: 50%">
        <b><label id="inputGroup-sizing-sm" >Total del gastos</label></b>
        <input  type="text" name="total_gasto" id="total_gasto" class="form-control" value="{{old('total_gasto')}}" maxlength="5"
        placeholder="Total gasto">
    </div>
    &nbsp;&nbsp; &nbsp;
     {{-- Responsable del gasto--}}
     <div class="col" style="width: 50%">
        <b><label id="inputGroup-sizing-sm" for="Categorias" >Responsable del gasto</label></b>
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
            <button class="btn btn-outline-dark" type="submit"> <i class="bi bi-folder-fill" > Guardar</i></button>
            <button type="reset" class="btn btn-outline-dark"> <i class="bi bi-eraser-fill"> Limpiar</i></button>

        <button type="button" class="btn btn-outline-dark"><a class="a" href="{{route('gasto.index')}}"><i class="bi bi-x-circle-fill"> Cerrar</i> </a></button>
        </center>

    </div>
    <br><br>




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

