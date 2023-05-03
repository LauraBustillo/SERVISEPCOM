@extends('main')
@section('extra-content')

<style>
    div.container {

width: 100% !important;
height: 100% !important;
padding-left: 10% !important;
}
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


div.container {

width: 100% !important;
height: 100% !important;
padding-left: 10% !important;
}
</style>

<h1 class="titulo1">Información del pedido</h1>
<br>

<div>    
    <div class="titulo" > Pedido N°: {{ $pedido->numero_pedido }} </div>
<br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Datos</th>
                <th>Información</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Fecha pedido</td>
                <td>{{ $pedido->fecha_pedido }}</td>

            </tr> 
            <tr>
                <td>Fecha recibido</td>
                <td>{{ $pedido->fecha_recibido == null ? 'No recibido':$pedido->fecha_recibido}}</td>


            </tr>
            <tr>
                <td>Estado</td>
                <td>{{ $pedido->estado == 0 ? 'Pendiente':'Recibido' }}</td>

            </tr>
            <tr>
                <td>Proveedor</td>
                <td>{{ $pedido->Proveedor }}</td>

            </tr>
            <tr>
                <td>Encargado</td>
                <td>{{ $pedido->Nombre_encargado }}</td>

            </tr>
            <tr>
                <td>Correo empresa</td>
                <td>{{ $pedido->Correo }}</td>

            </tr>
            <tr>
                <td>Teléfono</td>
                <td>{{ $pedido->Telefono_encargado }}</td>

            </tr>


            



        </tbody>
    </table>

  </div>
  <br>



        <div style="direction: flex" class="col-md-12 table-responsive">
            <table  class="table">
                <thead>
                    <tr >
                        <th>Nombre producto</th>
                        <th>Marca</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody id="tabladetallespedido">
                    </tbody>
            </table>
            </div>
  <br>
  <a class="button button-blue " href="{{ route('index.pedido') }}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>
  <a class="button button-blue " href="{{route('editar.pedido' , ['id' => $pedido->id]) }}"> <i class="bi bi-pen-fill"> Editar </i> </a>


  <script>
    var productosprov;
 var detalles_pedido = {!! json_encode($detalles_pedido, JSON_HEX_TAG) !!}; 
 dibujarTablaDetalles();
function dibujarTablaDetalles(){
        let html = ''
       
        if(detalles_pedido.length > 0){
        detalles_pedido.forEach(element => {
            html += '<tr>'
            html += '<td>'+element.Nombre_producto+'</td>'
            html += '<td>'+element.Marca+'</td>'
            html += '<td>'+element.Descripcion+'</td>'
            html += '<td>'+element.Cantidad+'</td>'
            html += '</tr>'      
        });
        }
       

        document.getElementById('tabladetallespedido').innerHTML = html;
}

  </script>
  

@endsection
@include('common')