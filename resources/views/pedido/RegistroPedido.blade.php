@extends('main')
@section('extra-content')

<style>
/*Los titulos */ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #000000;
  font-family: 'Open Sans';
  font-size: 20xp;
}

/*Cajas de texto*/ 
.form-control  {
    background-color: transparent;
    border: 1.3px solid #000000;

}
/*Alinear Div*/ 
.divaling {
  position: relative;
  right: -4%;
}

/*Alinear botones*/ 
.divalingn {
  position: relative;
  right: -8%;
}

/*Las label*/ 
.input-group-text  {
  background-color: #000000;
  border: 1.3px solid #000000;
  font-family: 'Open Sans';
  color: #FFFFFF;

}

/*Los botones*/ 
.btn-outline-dark {
 
  background-color: transparent;
  border: 1.8px solid #000000;
}
.btn-outline-dark:hover{
    background-color: rgb(48, 48, 48);
    color: white;
}

a { color: aliceblue;
  outline: none;
  text-decoration: none;
  color: #000000;
}
.a:hover{
    background-color: rgb(48, 48, 48);
    color: white;
}
.ancho-alto {
        width: 182%;
        height: 40%;
        resize: none;
    }
</style>

<form class="form-control"  method="POST" style="text-align: center;">

<h1 class="titulo">Pedido de productos</h1>
<br>

<div class="row g-4 divaling">
  <div class="col-sm-7">
  <span class="input-group-text" id="inputGroup-sizing-sm" style="width: 35%">Numero del pedido</span> 
    <input type="text" class="form-control"  style="width: 35%" placeholder="ej. xxxxxxxxxxx"  >
  </div>
  <div class="col-sm-2">
  <span class="input-group-text" id="inputGroup-sizing-sm">Fecha y Hora del pedido</span> 
    <input type="datetime-local" class="form-control" placeholder="Fecha del pedido">
  </div>
  <div class="col-sm-2">
  <span class="input-group-text" id="inputGroup-sizing-sm">Fecha del recibo</span> 
    <input type="date" class="form-control" placeholder="Fecha del pedido"  >
  </div>
</div>

<br>

<div class="card border-dark mb-3 form-control" style="max-width: 100rem;">
  <div class="card-header"><h6>Datos del proveedor</h6></div>
  <div class="card-body text-da<h5>rk">

  <div >
  {{-- proveedores--}}
      <div class="col col-sm-2" >
      <label for="Proveedores">Proveedor</label>
      <select style="background: transparent">
      <option value=>Seleccione</option>
    <option >proveedor</option>
  </select> 
  </div> 
  <br>

  <div class="row g-3 ">
  <div class="col-sm-4">
    <input type="text" class="form-control" placeholder="Encargado"  >
  </div>
  <div class="col-sm-5">
    <input type="text" class="form-control" placeholder="Correo Electronico" >
  </div>
  <div class="col-sm-3">
    <input type="text" class="form-control" placeholder="Telefono">
  </div>
</div>

  </div>
</div>
</div>

<div class="card border-dark mb-3 form-control" style="max-width: 100rem;">
  <div class="card-header"><h6>Datos del Producto</h6></div>
  <div class="card-body text-dark">

  <div class="row g-3 ">
  <div class="col-sm-4">
    <input type="text" class="form-control" placeholder="Nombre del producto"  >
  </div>
  <div class="col-sm">
    <input type="text" class="form-control" placeholder="Marca del producto" >
  </div>
  <div class="col-sm">
    <textarea class="form-control" placeholder="Descripción"></textarea>
  </div>
</div>

<br>

<div class="row g-2 ">
  <div class="col-sm-2">
    <input type="text" class="form-control" placeholder="Cantidad" >
  </div>
  <div class="col-sm-2">
    <input type="text" class="form-control" placeholder="Precio">
  </div>
  <div  class="col-sm-2 divalingn ">
  <button   class="btn btn-outline-dark"><i class="bi bi-folder-fill"> Agregar</i></button>
  </div>
  <div class="col-sm-2 ">
  <button   class="btn btn-outline-dark"><i class="bi bi-folder-fill"> Limpiar</i></button>
</div>


</div>

</div>
</div>
</div>







</form>






@endsection
@include('common')