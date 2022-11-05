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
<h1 class="titulo" style="text-align:center">Listado de proveedores</h1> 
<br>
<nav class="navbar navbar-nav bg-nav" >
  <div class="container-fluid" >
    <form class="d-flex" id="ablescroll" method="POST" action="Proveedor">
    @csrf
      <input type="text" style="width: 500px;"  class="form-control me-2" name="buscar" value="{{$buscar}}" placeholder="Buscar por nombre de la empresa o del encargado" aria-label="Sizing example input">
      <button  type="submit" class="btn btn-outline-dark me-2" id="buscar" name="buscador" value=" "><i class="bi bi-search"> </i></button>
      <a href="{{ route('proveedor.index') }}" class="btn btn-outline-dark" ><i class="bi bi-x-square"></i></a>
    </form>
         <a    class="btn btn-outline-dark" style="float:right" href="{{route('show.registroProveedor')}}" >
         <i class="bi bi-person-plus-fill"> Nuevo proveedor </i></a>
  </div>
  </nav>

<br>

<div>    
    <table class="table table-hover">
        <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre de la empresa</th>
        <th scope="col">Teléfono de la empresa </th>
        <th scope="col">Nombre del encargado</th>
        <th scope="col">Detalles del proveedor</th>
        <th scope="col">Editar proveedor</th>  
        </tr>
        </thead>

     <tbody>   
        @forelse($proveedores as $pro)

        <tr>
        <td scope="row">{{ $pro->id}}</td>
        <td>{{ $pro->Nombre_empresa }}</td>
        <td>{{ $pro->Telefono_empresa }}</td>
        <td>{{ $pro->Nombre_encargado }}</td>
        
        {{-- Botones --}}
       <td><a class="btn-detalles" href="{{route('proveedor.mostrar' , ['id' => $pro->id]) }}"> <i class="bi bi-file-text-fill"> Detalles </i> </a></td>
       <td><a class="btn-detalles" href="{{route('proveedor.editar' , ['id' => $pro->id]) }}"> <i class="bi bi-pen-fill"> Editar </i></a></td>
       </tr>
       @empty
       @endforelse
      
    </tbody>
    </table>
  </div>

  

{{ $proveedores->links() }}

@endsection
@include('common')