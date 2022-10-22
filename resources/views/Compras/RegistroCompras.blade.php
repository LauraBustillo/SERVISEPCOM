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

a { color: aliceblue;
  outline: none;
  text-decoration: none;
  color: #000000;
}
.a:hover{
    color: white;
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
<form class="form-control" id="form_guardarCo" name="form_guardarCo" method="POST" style="text-align: center;" onsubmit="confirmar()">
@csrf
<br>
<br>

       {{-- Título --}}
       <H1 class="titulo" >Registrar compra</H1>
       <br>
       <br>

        {{--Número de  factura--}} 
       <div class="input-group input-group-sm mb-1 " style="padding-right:4%"  style="width: 150%"> <br>
        <div class="col" style="padding-left:6%" > 
            <span class="input-group-text" style="width: 90%"  id="inputGroup-sizing-sm"> Número de factura </span>
            <input type="text" style="width: 90%"   minlength="8" maxlength="8" name="Numero_factura" id="Numero_factura"
             class="form-control" aria-label="Sizing example input"aria-describedby="inputGroup-sizing-sm" 
             required title=" solo debe contener números."  pattern="[0-9]+"  placeholder="Ingrese el número de factura" 
           value="{{old('Numero_factura')}}">
        </div>
    
         {{-- Fecha de facturación --}}
        <div class="col" style="padding-left:10%">
        <span class="input-group-text">Fecha de facturación</span>
        <input type="date"  name="Fecha_facturacion" id="fechaActual"  aria-label="First name" class="form-control" 
        require  placeholder="Fecha de facturación" value="{{old('Fecha_facturacion')}}">
        </div>

        {{-- Total de la factura --}}
        <div class="col" style="padding-left:10%" > 
            <span class="input-group-text" style="width: 90%"  id="inputGroup-sizing-sm">Total de la factura </span>
            <input type="text" style="width: 90%"   minlength="3" maxlength="5" name="Total_factura" id="Total_factura"
             class="form-control" aria-label="Sizing example input"aria-describedby="inputGroup-sizing-sm"
              required title=" solo debe contener números."  pattern="[0-9.]+"  placeholder="Ingrese el total de la factura"
           value="{{old('Total_factura')}}">
        </div>
      </div>
      <br>
      <br>

      {{--Botones --}}
      <button   class="btn btn-outline-dark"  type="submit" ><i class="bi bi-folder-fill"> Guardar</i></button>
      <button type="reset" class="btn btn-outline-dark"> <i class="bi bi-file-text-fill"> Detalles de factura </i></button>
      <button type="button" class="btn btn-outline-dark">
    <a class="a"><i class="bi bi-x-circle-fill"> Cerrar</i> </a></button>
 
</form>

@endsection

       {{--mensaje de confirmacion --}}
@push('alertas')
    <script>
        function confirmar() {
           var formul = document.getElementById("form_guardarCo");
           
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