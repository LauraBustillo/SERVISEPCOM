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
<form class="form-control" method="POST" id="form_guardarRF" name="form_guardarRF" action="{{ route('store.rangofactura') }}" onsubmit="guardarRango()">
    @csrf
    <br>
    <br>

    {{-- Título --}}
    <H1 class="titulo" style="text-align: center;">Registrar rango factura</H1>
    <br>
    <br>


    <div class="input-group input-group-sm flex">
        {{-- Fecha Inicio --}}
        <div class="col">
            <span class="input-group-text" id="inputGroup-sizing-sm">Número CAI</span>
            <input  type="text" name="caiRango" id="caiRango" class="form-control" value="{{old('caiRango')}}" maxlength="37">
        </div>
    </div>
    <br>
    <div class="input-group input-group-sm flex">
        {{-- Fecha Inicio --}}
        <div class="col">
            <span class="input-group-text" id="inputGroup-sizing-sm">Fecha Inicio</span>
            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" value="{{old('fechaInicio')?old('fechaInicio'):Carbon\Carbon::now()->timezone('America/Tegucigalpa')->format('Y-m-d')}}">
        </div>
        &nbsp;&nbsp;&nbsp;
        {{-- Fecha Vencimiento --}}
        <div class="col">
            <span class="input-group-text" id="inputGroup-sizing-sm">Fecha Vencimiento</span>
            <input type="date" name="fechaVencimiento" id="fechaVencimiento" class="form-control" value="{{old('fechaVencimiento')}}">
        </div>
    </div>

    <br>
    <div class="input-group input-group-sm flex">
        {{-- Factura Inicial --}}
        <div class="col">
            <span class="input-group-text" id="inputGroup-sizing-sm">Factura Inicial</span>
            <input type="text" name="facturaInicial" id="facturaInicial" class="form-control" value="{{ old('facturaInicial') }}" placeholder="Ej.000-000-00-00000000" maxlength="19">
        </div>
        &nbsp;&nbsp; &nbsp;
        {{-- Factura Final --}}
        <div class="col">
            <span class="input-group-text" id="inputGroup-sizing-sm">Factura Final</span>
            <input type="text" name="facturaFinal" id="facturaFinal" class="form-control" value="{{old('facturaFinal')}}" placeholder="Ej.000-000-00-00000000" maxlength="19">
        </div>
    </div>
    <br><br>

    <script>
        var d = new Date();
        var offset = -6; // offset para la hora de Honduras en GMT
        d.setHours(d.getHours() + offset);
        document.getElementById("fechaInicio").min = d.toISOString().split("T")[0];
        d.setMonth(d.getMonth() + 1);
        document.getElementById("fechaVencimiento").min = d.toISOString().split("T")[0];

        function validar(event) {
            // se obtiene el valor actual del carácter presionado en el teclado y se almacena en la variable value
            var value = event.key;
            //se obtiene el valor actual del elemento facturaFinal y se almacena en la variable texto
            var input = this;
            var texto = input.value;
            /*
                La función isNaN se utiliza para determinar si un valor es un
                número o no. parseInt se utiliza para convertir una cadena en
                un número entero. Si el valor actual no es un número,
                se cancela el evento predeterminado
                (utilizando event.preventDefault()) y se detiene la ejecución
                del controlador de eventos
            */
            if (isNaN(parseInt(event.key))) {
                event.preventDefault();
                return;
            }
            /*
                se comprueba si la longitud del texto actual es 3, 7 o 10 caracteres y,
                si es así, se agrega un guion al final del texto
                para simular el formato especificado por la SAR (XXX-XXX-XX-XXXXXXXX)
            */
            if (texto.length == 3 || texto.length == 7 || texto.length == 10) {
                texto += '-';
                /*
                    valor resultante con los guiones se asigna
                    de nuevo al elemento facturaFinal y se mostrará
                    en el campo de texto HTML.
                */
                input.value = texto;
            }
        }
        //se agrega un controlador de eventos para el evento keypress en el elemento con id facturaFinal
        document.getElementById("facturaFinal").addEventListener("keypress", validar);
        //se agrega un controlador de eventos para el evento keypress en el elemento con id facturaInicial
        document.getElementById("facturaInicial").addEventListener("keypress", validar);


        function validarCai(event) {
            var value = event.key;
            var input = this;
            var texto = input.value;
            if (isNaN(parseInt(event.key,16))) {
                event.preventDefault();
                return;
            }
            if (texto.length == 6 || texto.length == 13 || texto.length == 20 || texto.length == 27 || texto.length == 34) {
                texto += '-';
                input.value = texto;
            }
        }

        document.getElementById("caiRango").addEventListener("keypress", validarCai);


    </script>

    {{--Botones --}}
    <center>
        <button class="btn btn-outline-dark" type="submit"> <i class="bi bi-folder-fill"> Guardar</i></button>
        <button type="reset" class="btn btn-outline-dark"> <i class="bi bi-eraser-fill"> Limpiar</i></button>
        <button type="button" class="btn btn-outline-dark"><a class="a" href="{{route('RangoFactura.index')}}"><i class="bi bi-x-circle-fill"> Cerrar</i> </a></button>
    </center>
</form>


@endsection

{{--mensaje de confirmacion --}}
@push('alertas')
    <script>
        function guardarRango() {
           var formul = document.getElementById("form_guardarRF");
           
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

