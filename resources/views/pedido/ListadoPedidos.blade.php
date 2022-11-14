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
<h1 class="titulo" style="text-align:center">Listado de pedidos</h1> 
<br>
<nav class="navbar navbar-nav bg-nav" >
  <div class="container-fluid" >
     <form class="d-flex" id="ablescroll" method="POST" action="pedidos">
    @csrf
      <input type="text" style="width: 500px;"  class="form-control me-2" name="buscar" value="{{$buscar}}" placeholder="Buscar por número de pedido y fecha de pedido" aria-label="Sizing example input">
      <button  type="submit" class="btn btn-outline-dark me-2" id="buscar" name="buscador" value=" "><i class="bi bi-search"> </i></button>
      <a href="{{ route('index.pedido') }}" class="btn btn-outline-dark" ><i class="bi bi-x-square"></i></a>
    </form> 
         <a    class="btn btn-outline-dark" style="float:right" href="{{route('create.pedido')}}" >
         <i class="bi bi-person-plus-fill"> Nuevo pedido </i></a>
  </div>
  </nav>
<br>

<div>    

    <table class="table table-hover" id="tabla">
        <thead>
        <tr>
            <th scope="col">Número pedido</th>
            <th scope="col">Fecha pedido</th>
            <th scope="col">Fecha recibido</th>
            <th scope="col">Estado</th>
            <th scope="col">Detalles</th>
            <th scope="col">Editar pedido</th>
            <th scope="col"></th>
        </tr>
        </thead>

     <tbody>   
        @forelse($pedidos as $p)
        <tr>
            <td>{{ $p->numero_pedido }}</td>
            <td>{{ $p->fecha_pedido }}</td>
            <td>{{ $p->fecha_recibido == null ? 'No recibido': $p->fecha_recibido}}</td>
            <td>{{  $p->estado == 0 ? 'Pendiente':'Recibido' }}</td>
            <td><a class="btn-detalles" href="{{route('pedido.mostrar' , ['id' => $p->id]) }}"> <i class="bi bi-file-text-fill"> Detalles </i> </a></td>

            <td><a class="btn-detalles" href="{{route('editar.pedido' , ['id' => $p->id]) }}"> <i class="bi bi-pen-fill"> Editar </i> </a></td>
       </tr>
       @empty
       @endforelse
    </tbody>
    </table>
  </div>

{{ $pedidos->links() }}


@endsection
@include('common')