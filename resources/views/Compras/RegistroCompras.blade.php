@extends('main')
@section('extra-content')


{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"> --}}

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
.group-text {
  background-color: transparent;
  font-family: 'Open Sans';
  color: #000000;

}
/*Letra del titulo del modal */ 
.group-texto {
  background-color: transparent;
  font-family: 'Open Sans';
  color: #000000;
  font-size: 25px;
  
 

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

.col1{
    width: 9%;

}

.col2{
    width: 91%;
    
}

.row{
    display: flex;
    width: 100%;
    
}

.modal-body{
    background-color: rgb(142, 220, 243)!important;
   
}

.modal-header{
    background-color: rgb(184, 234, 249)!important;
    
}

.modal-content{
    background-color: rgb(184, 234, 249)!important;
   
}

.ancho{
    width: 20%;
}
.input{
    background-color: transparent;
    border: 1.8px solid #000000;
}



</style>

<div id="alert_factura">
</div>

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

<form  class="form-control"  onsubmit="confirmar()">
@csrf
<br>
<br>
       {{-- Título --}}
       <H1 class="titulo" style="text-align: center;">
        @if ($accion == 'guardar')Registrar @endif
        @if ($accion == 'editar')Actualizar @endif
         
        factura de compra</H1>
        <br>
        <div style="padding-left:2%"  >
        <label  style="padding-left:3% " >Número de factura</label> 
        <input minlength="11" maxlength="11" {{ $accion == 'guardar' ? '' : 'disabled' }} onkeyup="cargarNumeroFactura()" type="text" style="position:absolute;
         right:50% " name="Numero_factura" id="Numero_factura"  aria-label="Sizing example input" onkeypress="ValidaSoloNumeros4()"
         aria-describedby="inputGroup-sizing-sm" class="input ancho" required 
         title="Solo debe contener números" value="{{old('Numero_factura')}}" >
        </div>
        <br>

    {{-- Fecha de facturación --}}
    <div style="padding-left: 5%"  >
    <label >Fecha de facturación</label>
    <input {{ $accion == 'guardar' ? '' : 'disabled' }} type="date" style="position:absolute; right:50%"  name="Fecha_facturacion" id="Fecha_facturacion" 
    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  class="input ancho"
    required  placeholder="Fecha de nacimiento" value="{{old('Fecha_facturacion')}}">
    </div>
   <br>
  
   {{-- proveedores--}}
    <div style="padding-left: 5%"   >
    <label for="Proveedores">Proveedor</label>
    <select {{ $accion == 'guardar' ? '' : 'disabled' }} style="position:absolute; right:50%" name="Proveedor" id="Proveedor"  class="input ancho" style="background: transparent">
     <option value="" required [readonly]='true'>Seleccione</option>
     @foreach ($proveedores as $p)
     <option  value="{{$p->id}}" >{{$p->Nombre_empresa}}</option>         
     @endforeach
   </select> 
    </div> 
    <br>

  
    <br>

      {{--Botones --}}
       <div >
            <button  onclick="openmodal()"  class="btn btn-outline-dark" type="button">
                <i class="bi bi-file-text-fill"> Agregar Detalle </i>
            </button>
        </div>
      <br>
      <br>

       <table class="table table-hover">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Cantidad</th>
                <th>Precio de compra</th>
                <th>Precio de venta</th>
                <th>Impuesto</th>
                <th>Total Producto</th>
                <th>Eliminar</th>
                
            </tr>
        </thead>
        <tbody id="body_table_detallesFac">
               
            </tbody>
    </table>

         {{--Botones guardar y actualizar --}}
         <form action=""  id="form_guardarCo" name="form_guardarCo" method="POST"  onsubmit="confirmar()" >
         <div style="text-align: center">
            @if ($accion == 'guardar')
              <button  onclick="guardatFactura()" class="btn btn-outline-dark"  type="button" >
              <i class="bi bi-folder-fill"> Guardar</i>
              </button>  
              <button class="btn btn-outline-dark"  type="button" >
              <a class="a"  href="{{route('compra.index')}}"><i class="bi bi-x-circle"> Cerrar </i></a>
            </button>       
            @endif
        
               {{--Botones --}}
              @if ($accion == 'editar')
               <button  onclick="actualizarFactura()" class="btn btn-outline-dark"  type="button" >
               <i class="bi bi-folder-fill"> Actualizar</i>
               </button>         
               <button class="btn btn-outline-dark"  type="button" >
                <a class="a"  href="{{route('compra.index')}}"><i class="bi bi-x-circle"> Cerrar </i></a>
              </button>  
             @endif
       
              <button
              hidden
               type="button" 
               data-bs-toggle="modal" 
               data-bs-target="#staticBackdrop"
               id="openoriginalmodal"> 
              </button>
         </div>
        </form>

        </form>

       