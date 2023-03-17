<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        /* Estilos CSS para la factura */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table,
        .th,
        .td {
            border: 1px solid #000;
        }

        .th,
        .td {
            padding: 5px;
            text-align: left;
        }

        .th {
            background-color: #ccc;
            text-align: center;
        }


        .container {
            width: 100%;
            margin: 0 auto;
            background-color: #fff;
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-left: calc(-.5 * var(--bs-gutter-x));
        }

        .column {
            padding: 10px;
            width: 80%;
        }

        .column1 {

            width: 20.33333%;
        }

        .column2 {

            width: 60.66666%;
        }

        .text-justify {
            text-align: justify;
        }
    </style>
</head>

<body>
    <center>
        <h1>Garantia</h1>
    </center>
    <table>
        <thead>
            <tr>
                <td><img src="{{ asset('imagenes/Sepcom-logo-removebg-preview.png') }}" alt="Logo.png" width="150px"
                        height="150px"></td>
                <td colspan="3">
                    <div class="text-justify">
                        <h3>Servicios Profesionales En Computación</h3>
                        <p>Bo. Tierra Blanca, cuadras al norte del Museao Municipal, esquina opuesta a Ferreteria
                            Valladares,
                            Danlí, El Paraíso
                        </p>
                        <p>Tel/fax: 2763-5610 Cel: 9993-3462 / 3310-3508</p>
                        <p><b>RTN: 07031978003476 - E-mail: sepcom2003@hotmail.com</b></p>
                        <p><b>De: DANIEL EDUARDO BUSTILLO GODOY</b></p>
                        <p> <b> Para: </b><u>{{ $factura->clienteFactura }}</u></p>
                        <p style="text-align: left" colspan="2"><p> <b> Número de factura:</b> <b>{{ substr($factura->numeroFactura, 0, 14) }}</b> <b>{{ substr($factura->numeroFactura, 14, 19) }}</b>  </p></p>


                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <center>
        <div class="container">
            <div class="row">
                <div class="column1">

                </div>

            </div>
        </div>
    </center>

    <h3><b>GARANTÍA POR COMPUTADORA</b></h3>

    <p style="text-align:justify"> Se aplicará a cualquier computadora nueva comprada a partir de {{ Carbon\Carbon::parse( $factura->fechaFactura)->setTimezone('America/Tegucigalpa')->format('d-m-Y') }} hasta {{ Carbon\Carbon::parse( $factura->fechaFactura)->setTimezone('America/Tegucigalpa')->addDays(30)->format('d-m-Y') }}.

        Garantizamos que la computadora funcionará sin defectos en materiales y mano de obra durante un período de
        30 dias a partir de la fecha de venta original. Si la computadora presenta algún defecto
        durante el período de garantía, SEPCOM se compromete a reparar o reemplazar el
        producto sin costo adicional para el cliente.

        Esta garantía por computadora se aplica solo a la computadora y no cubre los accesorios, software, periféricos u
        otros dispositivos que no sean parte del equipo original vendido por SEPCOM. Además,
        la garantía no cubre ningún daño causado por accidentes, uso indebido, abuso, negligencia o cualquier otra causa
        que no sea defecto en los materiales o mano de obra.

        Para hacer uso de la garantía, el cliente deberá presentar una prueba de compra original y cumplir con cualquier
        otra política o procedimiento de garantía que pueda requerir SEPCOM.</p>

    <h3><b>GARANTÍA POR IMPRESORAS</b></h3>

    <p style="text-align:justify" >Se aplicará a cualquier impresora nueva comprada a partir de {{ Carbon\Carbon::parse( $factura->fechaFactura)->setTimezone('America/Tegucigalpa')->format('d-m-Y') }} hasta {{ Carbon\Carbon::parse( $factura->fechaFactura)->setTimezone('America/Tegucigalpa')->addDays(20)->format('d-m-Y') }}.

        Garantizamos que la impresora funcionará sin defectos en materiales y mano de obra durante un período de
        20 dias a partir de la fecha de venta original. Si la impresora presenta algún defecto
        durante el período de garantía, SEPCOM se compromete a reparar o reemplazar el
        producto sin costo adicional para el cliente.

        Esta garantía por impresoras se aplica solo a la impresora y no cubre los cartuchos de tinta o toner,
        accesorios, software, periféricos u otros dispositivos que no sean parte de la impresora original vendida por
        SEPCOM. Además, la garantía no cubre ningún daño causado por accidentes, uso
        indebido, abuso, negligencia o cualquier otra causa que no sea defecto en los materiales o mano de obra.

        Para hacer uso de la garantía, el cliente deberá presentar una prueba de compra original y cumplir con cualquier
        otra política o procedimiento de garantía que pueda requerir SEPCOM.</p>

    <h3><b>GARANTÍA POR OTROS PRODUCTOS</b></h3>

    <p style="text-align:justify" >Se aplicará a cualquier producto nuevo comprado a partir de {{ Carbon\Carbon::parse( $factura->fechaFactura)->setTimezone('America/Tegucigalpa')->format('d-m-Y') }} hasta {{ Carbon\Carbon::parse( $factura->fechaFactura)->setTimezone('America/Tegucigalpa')->setTimezone('America/Tegucigalpa')->addDays(15)->format('d-m-Y') }}.

        Garantizamos que el producto funcionará sin defectos en materiales y mano de obra durante un período de
        15 dias a partir de la fecha de venta original. Si el producto presenta algún defecto durante
        el período de garantía, SEPCOM se compromete a reparar o reemplazar el producto sin
        costo adicional para el cliente.

        Esta garantía por otros productos se aplica solo al producto y no cubre accesorios, software, periféricos u
        otros dispositivos que no sean parte del producto original vendido por SEPCOM.
        Además, la garantía no cubre ningún daño causado por accidentes, uso indebido, abuso, negligencia o cualquier
        otra causa que no sea defecto en los materiales o mano de obra.

        Para hacer uso de la garantía, el cliente deberá presentar una prueba de compra original y cumplir con cualquier
        otra política o procedimiento de garantía que pueda requerir SEPCOM.</p>

    <br>
    <p>Fecha:_____<u>{{ Carbon\Carbon::parse( $factura->fechaFactura)->setTimezone('America/Tegucigalpa')->setTimezone('America/Tegucigalpa')->format('d') }}</u>____ de:__<u>{{
            Carbon\Carbon::parse( $factura->fechaFactura)->setTimezone('America/Tegucigalpa')->formatLocalized('%B') }}</u>__Año <u>{{
            Carbon\Carbon::parse( $factura->fechaFactura)->setTimezone('America/Tegucigalpa')->setTimezone('America/Tegucigalpa')->format('Y') }}</u></p>
    <br>
    <div style="width: 100%; text-align: center">
        <p>Gracias por su compra.</p>
    </div>


    <script>
        setTimeout(function() {
            window.print();
        }, 1000); //
    </script>

</body>

</html>
