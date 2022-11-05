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
 
 
 {{-- Buscador--}}
 <h1 class="titulo" style="text-align:center">Listado de inventario</h1> 
 <br>
 <nav class="navbar navbar-nav bg-nav" >
   <div class="container-fluid" >
     <form class="d-flex" id="ablescroll" method="POST" action="Inventario">
     @csrf
       <input type="text" style="width: 500px;"  class="form-control me-2" name="buscar" value="{{$buscar}}" placeholder="Buscar por nombres, apellidos o identidad" aria-label="Sizing example input">
       <button  type="submit" class="btn btn-outline-dark me-2" id="buscar" name="buscador" value=" "><i class="bi bi-search"> </i></button>
       <a href="{{ route('inventario.index') }}" class="btn btn-outline-dark" ><i class="bi bi-x-square"></i></a>
     </form>
   </div>
   </nav>
 
 <br>
 
 <div>    
     <table class="table table-hover">
         <thead>
         <tr>
         
         <th scope="col">Nombre del producto</th>
         <th scope="col">Marca</th>
         <th scope="col">Provedor</th>
         <th scope="col">Cantidad</th>
         <th scope="col">Categoria</th>
         <th scope="col">Detalles</th>  
         </tr>
         </thead>
 
      <tbody>   
         @forelse($inventario as $in)
 
         <tr>
         <td scope="row">{{ $in->Nombre_producto}}</td>
         <td>{{ $in->Marca }}</td>
         <td>{{ $in->Nombre_empresa}}</td>
         <td>{{ $in->Cantidad}}</td>
         <td>{{ $in->Categoria}}</td>
         
         {{-- Botones --}}
         <td><a class="btn-detalles" href="{{route('inventario.mostrar' , ['id' => $in->id_producto]) }}"> <i class="bi bi-file-text-fill"> Detalles </i> </a></td>
       
        </tr>
        @empty
        @endforelse
     </tbody>
     </table>
   </div>
 {{-- {{ $inventario->links() }} --}}
@endsection
@include('common')