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
                        <p> <b> Para: </b><u>{{ $factura->cliente->Nombre. ' '. $factura->cliente->Apellido  }}</u></p>

                        {{--<p style="text-align: left" colspan="2"><p> <b> Número de factura:</b> <b>{{ substr($factura->numeroFactura, 0, 14) }}</b> <b>{{ substr($factura->numeroFactura, 14, 19) }}</b>  </p></p>--}}

                        <p style="text-align: left" colspan="2"><b>Número de factura: <b>{{ substr($factura->numero_factura, 0, 14) }}</b> {{ substr($factura->numero_factura, 14, 19) }}</b>  </p>



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

    <h3><b>GARANTÍA POR CAMBIO DE PIEZA EN  REPARACIÓN</b></h3>


    <p style="text-align:justify" >En nombre de nuestra empresa, nos complace ofrecerle una garantía por el cambio de pieza en su reparación. Nos comprometemos a ofrecerle un servicio de alta calidad y a utilizar piezas de repuesto de la mejor calidad disponibles en el mercado.

        Si, por alguna razón, la pieza que hemos instalado en su dispositivo falla dentro de un período de {{ Carbon\Carbon::parse( $factura->fecha_factura)->setTimezone('America/Tegucigalpa')->format('d-m-Y') }} hasta {{ Carbon\Carbon::parse( $factura->fecha_factura)->setTimezone('America/Tegucigalpa')->addDays(30)->format('d-m-Y') }}, nos comprometemos a reemplazarla sin costo adicional para usted. La garantía solo es válida si la falla es causada por un defecto en la pieza y no por un mal uso del dispositivo.

        Para hacer efectiva la garantía, por favor, póngase en contacto con nuestro departamento de servicio al cliente y proporcione la información necesaria sobre la reparación realizada. Si se determina que la pieza defectuosa está cubierta por la garantía, se reemplazará de inmediato sin costo alguno para usted.

        Nuestro objetivo es asegurarnos de que su dispositivo funcione correctamente y que esté satisfecho con nuestro servicio. Si tiene alguna pregunta o inquietud acerca de la garantía, no dude en ponerse en contacto con nosotros.

        Agradecemos su confianza en nuestra empresa y esperamos poder seguir siendo su proveedor de servicios en el futuro.</p>

    <br>
    <p>Fecha:__<u>{{ Carbon\Carbon::parse( $factura->fecha_factura)->setTimezone('America/Tegucigalpa')->format('d') }}</u>_ de:__<u>{{
            Carbon\Carbon::parse( $factura->fecha_factura)->setTimezone('America/Tegucigalpa')->formatLocalized('%B') }}</u>__Año <u>{{
            Carbon\Carbon::parse( $factura->fecha_factura)->setTimezone('America/Tegucigalpa')->format('Y') }}</u></p>
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
