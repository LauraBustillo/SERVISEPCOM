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
  <input type="text" class="form-control" aria-label="Sizing example input" name="buscar" value="{{$buscar}}" placeholder="Nombre, apellido, o identidad">
</div>
</form>
</div>

<h1 class="titulo" style="text-align:center">Listado de empleados</h1>
<div>    
    <table class="table table-hover">
        <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">Primer nombre</th>
        <th scope="col">Primer apellido</th>
        <th scope="col">Número de identidad</th>
        <th scope="col">Detalles del empleado</th>
        <th scope="col">Editar empleado</th>  
        </tr>
        </thead>

     <tbody>   
        @forelse($empleados as $em)

        <tr>
        <td scope="row">{{ $em->id}}</td>
        <td>{{ $em->Primer_nombre }}</td>
        <td>{{ $em->Primer_apellido }}</td>
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