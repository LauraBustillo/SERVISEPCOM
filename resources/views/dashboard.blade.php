@extends('main')
@section('extra-content')

<style>
.form-control  {
    background-color: transparent;
    border: 1.5px solid #000000;
}
/* titulo principal */
.infographic-titlee {
    font-size: 35px;
    display: inline-block;
    line-height: 35px;
    font-weight: 100;
    width: 100%;
    text-align: center;
    text-transform: uppercase;
}
.infographic-titlee .inner-titlee {
  color: #000000;
  display: inline-block;
  letter-spacing: -2.5px;
  text-align: left;
  text-shadow: 2px 0 0 #fff, -2px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;

}
.infographic-titlee .inner-titlee span {
  padding-left: 60px;
  padding-right: 10px;
}
.infographic-titlee .inner-titlee strong {
  padding-right: 10px;
}


/* los otros titulos*/

.infographic-title {
    font-size: 30px;
    display: inline-block;
    line-height: 30px;
    font-weight: 100;
    width: 100%;
    text-align: center;
    text-transform: uppercase;
    margin-bottom: 20px;
    margin-top: 20px;

}
.infographic-title .inner-title {
  color: #000000;
  display: inline-block;
  letter-spacing: -2.5px;
  text-align: left;
  text-shadow: 2px 0 0 #fff, -2px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;

}
.infographic-title .inner-title span {
  padding-left: 60px;
  padding-right: 10px;
}
.infographic-title .inner-title strong {
  padding-right: 10px;
}


.sep{
  font-family: 'Playfair Display', 'Georgia', serif;
  font-size: 25px;
  color:#17202A ;
  text-shadow: 2px 0 0 #fff, -2px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;
}

p { 
  font-weight: bold; 
  font-style: italic;
  text-align: center;
}

.card-text{
  font-weight: bold; 
  font-style: italic;
  text-align: center;
}

.divseccion{
  width: 200px;
  height: 60px;
}


div.container {
        width: 100% !important;
        height: 100% !important;
        padding-left: 10% !important;
    }

</style>

@if (session('denegar'))
  <script>
    mensaje = {!! json_encode(session('denegar'), JSON_HEX_TAG) !!};
    alertify.success(mensaje);
  </script>
@endif


<div class="infographic-titlee"><span class="inner-titlee"><strong>¡Bienvenido</strong>a<br><span>SERVI</span><strong>SEPCOM!</strong></span></div>
<p class="contenido"></p>
<p>En <b> SEPCOM </b> somos una empresa que presta servicos profesionales en computación, mantenimiento y reparacion, venta
  de computadoras, impresoras, tintas accesorios y mucho mas.
  <p>Ubicados en Bo. Tierra Blanca, 2 cuadras al norte del Museo Municipal, esquina opuesta a Ferreteria Valladares,
                            Danlí, El Paraíso.</p>
</p>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active carousel-item">
                        <div style="width: 100%;display:flex" >
                                <img src="imagenes/PRINCIPAL.jpg" id="avatarmodal" class="mx-auto" style="width: 50rem;height:23rem;color:black"
                                    alt="no imagen">
                                    <div class="carousel-caption d-none d-md-block sep" style="text-align:left;">

                                      <h1> <b> SEPCOM </b></h1>
                                      <label> <b>Localidades y productos</b></label>
                            </div>
                        </div>
                        </div>
                        <div class="carousel-item ">
                            <div style="width: 100%;display:flex">
                                <img src="imagenes/PRINCIPAL2.jpg" id="avatarmodal1" class="mx-auto" style="width: 50rem;height:23rem;color:black"
                                    alt="no imagen">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div style="width: 100%;display:flex">
                                <img src="imagenes/computadoras.jpg" id="avatarmodal2" class="mx-auto" style="width: 50rem;height:23rem;color:black"
                                    alt="no imagen">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div style="width: 100%;display:flex">
                                <img src="imagenes/imagen3.png" id="avatarmodal3" class="mx-auto" style="width: 50rem;height:23rem;color:black"
                                    alt="no imagen">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div style="width: 100%;display:flex">
                                <img src="imagenes/teclado1.jpg" id="avatarmodal4" class="mx-auto" style="width: 50rem;height:23rem;color:black"
                                    alt="no imagen">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div style="width: 100%;display:flex">
                                <img src="imagenes/Tintas1.jpg" src="imagenes/PRINCIPAL5.jpg" id="avatarmodal4" class="mx-auto" style="width: 50rem;height:23rem;color:black"
                                    alt="no imagen">
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <hr>

<div class="infographic-title"><span class="inner-title"><strong>¿Quienes</strong><br><span>somos?</span></div>
  <div class="row row-cols-1 row-cols-md-3 g-2 ">
  <div class="col ">
    <div class="card h-100 hover">
      <img src="imagenes/mision.gif" class="card-img-top" alt="...">
      <div class="card-body">
        <h3 class="card-title" style="text-align: center;">Misión</h3>
        <p class="card-text"> Empresa de servicio dedicada a satisfacer
           las necesidades de soporte técnico, mantenimiento, reparación y venta de accesorios 
           y equipo de cómputo que el cliente requiera, elevando así el rendimiento en sus equipos
            de una manera rápida y cómoda, a través del diagnóstico y supervisión de nuestro 
            personal, también con la asistencia en implementación de software para empresas con
             control de inventarios, facturación.</p>
      </div>
      <div class="card-footer">
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="imagenes/vision.gif" class="card-img-top" alt="...">
      <div class="card-body">
        <h3 class="card-title" style="text-align: center;">Visión</h3>
        <p class="card-text">Ser una empresa líder en el mercado regional, brindando servicios 
          de mantenimiento de cómputo asistiendo personalmente en el menor tiempo posible a 
          satisfacer las necesidades del cliente, dándole así atención personalizada y una 
          supervisión constante de sus equipos.</p>
      </div>
      <div class="card-footer">
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="imagenes/estrategicos.gif" class="card-img-top" alt="...">
      <div class="card-body">
        <h3 class="card-title"   style="text-align: center;">Objetivos estrategicos</h5>
        <p class="card-text">1). Acudir al llamado de nuestros clientes en el menor tiempo posible. <br>2). Proporcionar Servicio de Mantenimiento de Computo Rapido y Eficiente en la comodidad del hogar.<br> 3). Mantener una comunicacion constante con nuestros clientes, dandoles la seguridad de que sus equipos funcionan de manera adecuada en cualquier momento.
</p>
      </div>
      <div class="card-footer">
      </div>
    </div>
  </div>
</div>


<br>
<div class="card">
  <div class="card-header">
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0" style="text-align: center;">
      <p>Valores</p>
      <cite class="blockquote-footer Source Title">Responsabilidad</cite>
      <cite class="blockquote-footer Source Title">Respeto</cite>
      <cite class="blockquote-footer Source Title">Actitud de servicio</cite>
      <cite class="blockquote-footer Source Title">Trabajo en equipo</cite>
      <cite class="blockquote-footer Source Title">Mejora continua</cite>
      <cite class="blockquote-footer Source Title">Confiabilidad</cite>

    </blockquote>
  </div>
</div>

<hr>

<div class="infographic-title"><span class="inner-title"><strong>Secciones de</strong><br><span>servi-sepcom</span></div>

<div  class="row row-cols-1 row-cols-md-5 " >
  
<div class="card border-primary mb-3 " style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Clientes</div>
  <div class="card-body text-secondary"   style="text-align: center;">
    <a href="{{ route('cliente.index') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/cliente.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Permite crear, enlistar y editar los clientes que nos visitan. </p>
  </div>
</div>


<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Empleados</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a  href="{{ route('empleado.index') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/empleado.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Permite crear, enlistar y editar los empleados de SEPCOM.</p>
  </div>
</div>

<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Proveedores</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a href="{{ route('proveedor.index') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/edificio.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Permite crear, enlistar y editar los proveedores que nos avastecen.</p>
  </div>
</div>


<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Productos</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a href="{{ route('show.registroProductos') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/carrito.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Permite crear el registro de nuevos productos.</p>
  </div>
</div>

<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Compras</div>
  <div class="card-body text-secondary"   style="text-align: center;">
    <a href="{{ route('compra.index') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/compra.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Permite crear y detallar las compras que se realizan</p>
  </div>
</div>


</div>

<br>


<div  class="row row-cols-1 row-cols-md-5 g-3">
  


<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Pedidos</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a href="{{ route('index.pedido') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/pedidos.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Permite crear, enlistar y editar los pedisos que se realizaran.</p>
  </div>
</div>

<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Inventario</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a href="{{ route('inventario.index') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/inventario.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Permite mantener un control total de los productos en exitencia.</p>
  </div>
</div>


<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Servicios</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a href="{{ route('cliente.index') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/servicio.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Reparar o dar mantenimiento al equipo del cliente.</p>
  </div>
</div>

<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Rango de facturas</div>
  <div class="card-body text-secondary"   style="text-align: center;">
    <a href="{{ route('RangoFactura.index') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/factura.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">permite crear y enlistar los rangos de las facturas.</p>
  </div>
</div>

<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Ventas</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a  href="{{ route('Venta.index') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/caja.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Permite realizar y detallar las ventas de los productos.</p>
  </div>
</div>

</div>

<br>

<div  class="row row-cols-1 row-cols-md-5 g-3">
  
<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Devolución por garantia</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a href="{{ route('devolucion.index') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/devolucion.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Permite realizar y detallar devoluciones de ciertos productos.</p>
  </div>
</div>


<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Gastos</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a href="{{ route('gasto.index') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/gasto.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Mantiene un control detallado de los gastos de SEPCOM.</p>
  </div>
</div>

<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Usuarios</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a href="{{ route('index.usuario') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/usuario.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Permite crear y enlistar los Usuarios de SERVI-SEPCOM.</p>
  </div>
</div>

<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Planilla</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a href="{{ route('index.planilla') }}"><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/planilla.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Mantiene un control de los pagos realizados a los empleados de SEPCOM.</p>
  </div>
</div>
<div class="card border-primary mb-3" style="max-width: 14rem;">
  <div class="card-header" style="text-align: center; font-weight:bolder">Inicio de sesión</div>
  <div class="card-body text-secondary"   style="text-align: center;">
 <a ><button type="button" class="btn btn-outline-primary"  > <img src="imagenes/acceso.gif" alt="" style="max-width: 7rem;"></button></a>
    <p class="card-text">Permite el ingreso al sistema SEPCOM.</p>
  </div>
</div>
</div>

<hr>


@endsection
@include('common')
