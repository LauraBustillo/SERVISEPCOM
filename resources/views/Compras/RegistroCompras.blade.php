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

<form class="form-control " id="form_guardarCo" name="form_guardarCo" method="POST" style="text-align: center;" onsubmit="confirmar()">
@csrf
<br>
<br>

       {{-- Título --}}
       <H1 class="titulo" >Registrar compra</H1>
       <br>
  


    
         {{-- Fecha de facturación --}}
        <div class="col" style="padding-left:10%">
        <span class="input-group-text">Fecha de facturación</span>
        <input type="date"  name="Fecha_facturacion" id="fechaActual"  aria-label="First name" class="form-control" 
        require  placeholder="Fecha de facturación" value="{{old('Fecha_facturacion')}}">
        </div>

    
      <br>
      <br>

      {{--Botones --}}
      <button   class="btn btn-outline-dark"  type="submit" ><i class="bi bi-folder-fill"> Guardar</i></button>
      <button type="reset" class="btn btn-outline-dark"> <i class="bi bi-file-text-fill"> Detalles de factura </i></button>
      <button type="button" class="btn btn-outline-dark">
          <a class="a"><i class="bi bi-x-circle-fill"> Cerrar</i> </a>
       </button>
 
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