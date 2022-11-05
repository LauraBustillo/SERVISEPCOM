@extends('main')
@section('extra-content')
<style>
 
.input-group-text  {
  background-color: #B8D7F9;
  border: 1.5px solid #000000;
}

.form-control  {
    background-color: transparent;
    border: 1.5px solid #000000;
}

.table-1{
    width: 100%;
    color: rgb(3, 10, 1);
    border: 1px solid #000000;

}

.table-1 th{
    background-color: #0319C4;
    color:white;
    padding: .2rem;
    text-align: start;
}

.btn-info{
    background-color: transparent;
    border: 1px solid #000000;
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
  text-decoration: none;
  color: black;
  
}

/*Quitar subrayado*/ 
 a:link, a:visited, a:active, a:focus{
    text-decoration:none;
    Color: black; 
   
  }

</style>


@if (session('mensaje'))
  <script>
    mensaje = {!! json_encode(session('mensaje'), JSON_HEX_TAG) !!};
    alertify.success(mensaje);
  </script> 
@endif 


{{-- <div class="alert alert-success d-flex align-items-center" role="alert">
<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  {{session('mensaje')}}
</div> --}}

{{-- Buscador--}}
<h1 class="titulo" style="text-align:center">Listado de clientes</h1> 
<br>
<nav class="navbar navbar-nav bg-nav" >
  <div class="container-fluid" >
    <form class="d-flex" id="ablescroll" method="POST" action="Cliente ">
    @csrf
      <input type="text" style="width: 500px;"  class="form-control me-2" name="buscar" value="{{$buscar}}" placeholder="Buscar por nombres, apellidos o identidad" aria-label="Sizing example input">
      <button  type="submit" class="btn btn-outline-dark me-2" id="buscar" name="buscador" value=" "><i class="bi bi-search"> </i></button>
      <a href="{{ route('cliente.index') }}" class="btn btn-outline-dark" ><i class="bi bi-x-square"></i></a>
    </form>
         <a    class="btn btn-outline-dark" style="float:right" href="{{route('show.registroCliente')}}" >
         <i class="bi bi-person-plus-fill"> Nuevo cliente </i></a>
  </div>
  </nav>
<br>
<div>    

    <table class="table table-hover" id="tabla">
        <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Número de identidad</th>
        <th scope="col">Detalles del cliente</th>
        <th scope="col">Editar cliente</th>
        </tr>
        </thead>

     <tbody>   
        @forelse($clientes as $cl)
        <tr>
        <td scope="row">{{ $cl->id}}</td>
        <td>{{ $cl->Nombre }}</td>
        <td>{{ $cl->Apellido }}</td>
        <td>{{ $cl->Numero_identidad }}</td>

        {{-- Botones --}}
       <td><a class="btn-detalles" href="{{route('cliente.mostrar' , ['id' => $cl->id]) }}"> <i class="bi bi-file-text-fill"> Detalles </i> </a></td>
       <td><a class="btn-detalles" href="{{route('cliente.editar' , ['id' => $cl->id]) }}"> <i class="bi bi-pen-fill"> Editar </i> </a></td>
       </tr>
       @empty
       @endforelse
    </tbody>
    </table>
  </div>

  <Script>
function busquedaJQsimple() {
  var filtro = $("#buscar").val().toUpperCase();

  $("#tabla tbody tr").each(function() {
    texto = $(this).children("td:eq(0)").text().toUpperCase();
    
    if (texto.indexOf(filtro) < 0) {
      $(this).hide();
    } else{
      $(this).show();
    }
    
  });
  
}
</Script>


{{ $clientes->links() }}
@endsection
@include('common')