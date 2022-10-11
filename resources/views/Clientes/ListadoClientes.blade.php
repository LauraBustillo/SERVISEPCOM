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
<div class="alert alert-success">
  {{session('mensaje')}}
</div>
@endif

<div>

{{-- Boton nuevo cliente --}}
<a   class="btn-detalles " style="float:right" href="{{route('show.registroCliente')}}" >
  <i class="bi bi-person-plus-fill"> Nuevo cliente </i>
</a>

{{-- Buscador--}}
<form  id="ablescroll" method="POST" action="Cliente">
@csrf
<div class="input-group mb-3" style="width: 40%">
  <span class="input-group-text" id="inputGroup-sizing-default"> <i class="bi bi-search"></i></span>
  <input type="text" class="form-control" aria-label="Sizing example input" name="buscar" value="{{$buscar}}" placeholder="Nombre, apellido, o identidad">
</div>
</form>
</div>

<h1 class="titulo" style="text-align:center">Listado de clientes</h1> 
<div>    

    <table class="table table-hover" id="tabla">
        <thead>
        <tr>
        <th scope="col">Id</th>
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