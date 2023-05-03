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
                right: 415px;
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

<h1 class="titulo1">Información de la devolución</h1>
<br>

<div>
    <div class="titulo"> Pedido N°: {{ $devoluciones->id }}</div>
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
                <td>Número de factura</td>
                <td>{{ $devoluciones->detalle_venta->Numero_facturaform }}</td>

            </tr>


            <tr>
                <td>Nombre del producto</td>
                <td>{{ $devoluciones->producto->Nombre_producto }}</td>

            </tr>
            <tr>
                <td>Marca del producto</td>
                <td>{{ $devoluciones->producto->Marca }}</td>


            </tr>
            <tr>
                <td>Categoría</td>
                <td>{{ $devoluciones->Categoria->Descripcion }}</td>

            </tr>
            <tr>
                <td>Proveedor</td>
                <td>{{ $devoluciones->Proveedor->Nombre_empresa }}</td>

            </tr>
            <tr>
                <td>Descripción</td>
                <td>{{ $devoluciones->Descripcion }}</td>

            </tr>
            <tr>
                <td>Fecha de devolución</td>
                <td>{{ $devoluciones->Fecha_devolucion }}</td>
            </tr>
            <tr>
                <td>Fecha de facturación</td>
                <td>{{ $devoluciones->venta->fechaFactura }}</td>
            </tr>
            <tr>
                <td><label>Estado de devolución</label></td>
                <td>
                    <input @if($devoluciones->estado_devolucion == 'Realizado')
                    checked disabled
                    @endif class="form-check-input" type="checkbox" id="switchDev" name="switchDev">
                    <b></b>
                </td>
            </tr>

        </tbody>
    </table>
</div>
<br>


<div style="display: flex">  
    <div style="display: flex" class="mx-auto">
    
<a class="button button-blue "  href="{{ route('devolucion.index') }}"> <i class="bi bi-arrow-left-circle-fill"> Volver </i></a>

&nbsp;

<form action="{{ route('devolucion.editar', [ 'id' => $devoluciones->id ]) }}" method="post">
    @csrf
    <input type="checkbox"  name='check' id="check" style="display: none">
    <button class="button button-blue " type="submit" id="btn_form" style="display: none"> <i class="bi bi-repeat" > Actualizar</i></button>
</form>
</div>
</div>



<script>

    switchDev.addEventListener('change', function(element) {
        document.getElementById("check").checked = document.getElementById("switchDev").checked;
        document.getElementById('btn_form').style.display = "block";
    });

</script>




@endsection
@include('common')
