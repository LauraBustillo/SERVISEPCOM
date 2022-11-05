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

/*Quitar Subrayado*/ 
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



{{-- Buscador--}}
<h1 class="titulo" style="text-align:center">Listado de empleados</h1> 
<br>
<nav class="navbar navbar-nav bg-nav" >
  <div class="container-fluid" >
    <form class="d-flex" id="ablescroll" method="POST" action="Empleado">
    @csrf
      <input type="text" style="width: 500px;"  class="form-control me-2" name="buscar" value="{{$buscar}}" placeholder="Buscar por nombres, apellidos o identidad" aria-label="Sizing example input">
      <button  type="submit" class="btn btn-outline-dark me-2" id="buscar" name="buscador" value=" "><i class="bi bi-search"> </i></button>
      <a href="{{ route('empleado.index') }}" class="btn btn-outline-dark" ><i class="bi bi-x-square"></i></a>
    </form>
         <a    class="btn btn-outline-dark" style="float:right" href="{{route('show.registroEmpleado')}}" >
         <i class="bi bi-person-plus-fill"> Nuevo empleado </i></a>
  </div>
  </nav>

<br>

<div>    
    <table class="table table-hover">
        <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombres</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Número de identidad</th>
        <th scope="col">Detalles del empleado</th>
        <th scope="col">Editar empleado</th>  
        </tr>
        </thead>

     <tbody>   
        @forelse($empleados as $em)

        <tr>
        <td scope="row">{{ $em->id}}</td>
        <td>{{ $em->Nombres }}</td>
        <td>{{ $em->Apellidos }}</td>
        <td>{{ $em->Numero_identidad }}</td>
        
        {{-- Botones --}}
       <td><a class="btn-detalles" href="{{route('empleado.mostrar' , ['id' => $em->id]) }}"> <i class="bi bi-file-text-fill"> Detalles </i> </a></td>
       <td><a class="btn-detalles" href="{{route('empleado.editar' , ['id' => $em->id]) }}"> <i class="bi bi-pen-fill"> Editar </i></a>  </td>
       </tr>
       @empty
       @endforelse
    </tbody>
    </table>
  </div>
{{ $empleados->links() }}
@endsection
@include('common')