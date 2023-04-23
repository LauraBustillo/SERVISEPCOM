@extends('main')
@section('extra-content')

<style>
.input-group-text  {
  background-color: #B8D7F9;
  border: 1px solid #0319C4;
}

.form-control  {
    background-color: transparent;
    border: 1px solid #0319C4;
}

.btn-info{
    background-color: transparent;
    border: 1px solid #0319C4;
}
 


/*Los titulos */ 
.titulo {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #4c4d4e;
  font-family: 'Open Sans';
  font-size: 20px;
}
/*Los titulos */ 
.titulo1 {
  font: italic normal bold normal 3em/1 Helvetica, Arial, sans-serif;
  color: #4c4d4e;
  font-family: 'Open Sans';
  font-size: 40px;
  text-align: center;
}

.button {
    border-bottom: 1px solid hsla(0, 0%, 100%, 0);
    text-shadow: 0 1px 0 hsla(0, 0%, 0%, 0);
    text-decoration: none !important;
    text-transform: uppercase;
    color: #fff !important;
    font-weight: bold;
    border-radius: 5px;
    padding: 10px 20px;
    margin: 0 3px;
    position: relative;
    display: inline-block;
    -webkit-transition: all 0.1s;
    -moz-transition: all 0.1s;
    -o-transition: all 0.1s;
    transition: all 0.1s;
}
.button:active {
    -webkit-transform: translateY(7px);
    -moz-transform: translateY(7px);
    -o-transform: translateY(7px);
    transform: translateY(7px);
}

.button-blue {
    background: #4c4d4e;
    box-shadow: 0 5px 0 #161616,
                0 11px 5px hsla(0, 0%, 0%, 0.5);
}
.button-blue:active {
    box-shadow: 0 3px 0 #161616,
                0 4px 6px hsla(0, 0%, 0%, 0.7);
}

.boton1{
  border: none;
}
</style>


<h1 class="titulo1">Información del Producto</h1>
<br>
<div>    
<br>
    <table class="table table-hover" >

        <thead class="letra">
              <tr>
                <td>Datos</td>
                <td>Información</td>
            </tr>
        </thead>

        <tbody>
          


            <tr>
                <td>Nombre producto</td>
                <td>{{ $product->Nombre_producto }}</td>
            </tr>  

            <tr>
                <td>Descripción</td>
                <td>{{ $product->Descripcion }}</td> 
            </tr> 

            <tr>
                <td>Cantidad</td>
                <td>{{ $product->Cantidad }}</td> 
            </tr> 

            <tr>
                <td>Proveedor</td>
                <td>{{ $product->Nombre_empresa }}</td>
            </tr>  

            <tr>
                <td>Categoría</td>
                <td>{{ $product->Categoria }}</td> 
            </tr> 

            <tr>
                <td>Marca</td>
                <td>{{ $product->Marca }}</td>
            </tr>     

        </tbody>
    </table>
  </div>
  
  {{--Botones --}}
  
  
  <a  class="button button-blue " href="{{ route('inventario.index') }}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>
  <button  class="button button-blue "  type="button" data-bs-toggle="modal" data-bs-target="#modalHistorial"> <i class="bi bi-cash-coin" > Historial precios</i> </button>
 

 
<!-- Modal de dialogo de agregar producto --> 
<div class="modal fade"  id="modalHistorial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl" >
        <div class="modal-content">
            <div class="modal-header">
                <h1  class="group-texto titulo1 mx-auto" id="staticBackdropLabel" style="text-align: center">
                    <br>
                    Historial de precios
                </h1>              
            </div>

            <div class="modal-body" >
                    
 
                <table class="table table-hover" id="tabla">
                    <thead>
                        <tr>
                            <th scope="col">Número factura</th>
                            <th scope="col">Fecha modificación</th>
                            <th scope="col">Precio compra anterior</th>
                            <th scope="col">Precio compra actual</th>
                            <th scope="col">Precio venta anterior</th>
                            <th scope="col">Precio venta actual</th>
                        </tr>
                    </thead>
            
                    <tbody>   
                        @foreach($historial as $h)
                            <tr>
                                <td>{{ $h->num_factura}}</td>
                                <td>{{ $h->fecha_cambio}}</td>
                                <td>{{ $h->costo_antiguo}}</td>
                                <td>{{ $h->costo_nuevo }}</td>
                                <td>{{ $h->precio_antiguo }}</td>
                                <td>{{ $h->precio_nuevo }}</td>            
                            </tr>
                        @endforeach
                    </tbody>
                </table>                  
             
            </div>

            <!-- Botones -->
            <div class="modal-footer" style="text-align: center">
                <button  type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" ><i class="bi bi-x-circle"> Cerrar</i></button>
            </div>

        </div>
    </div>
</div>



@endsection
@include('common')