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

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
</svg>

@if (session('mensaje'))
<div class="alert alert-success d-flex align-items-center" role="alert">
<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  {{session('mensaje')}}
</div>
@endif


<div>
{{-- Boton nuevo empleado --}}
<a   class="btn-detalles " style="float: right" href="{{route('show.registroEmpleado')}}" >
  <i class="bi bi-person-plus-fill"> Nuevo empleado </i>
</a>

{{-- Buscador--}}
<form  id="ablescroll" method="POST" action="Empleado">
@csrf
<div class="input-group mb-3" style="width: 40%">
  <span class="input-group-text" id="inputGroup-sizing-default"> <i class="bi bi-search"></i></span>
  <input type="text" class="form-control" aria-label="Sizing example input" name="buscar" value="{{$buscar}}" placeholder="Nombre, apellido o identidad">
</div>
</form>
</div>

<h1 class="titulo" style="text-align:center">Listado de empleados</h1>
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