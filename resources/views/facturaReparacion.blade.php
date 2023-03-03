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
    <table>
        <thead>
            <tr>
                <td><img src="{{ asset('imagenes/Sepcom-logo-removebg-preview.png') }}" alt="Logo.png" width="150px" height="150px"></td>
                <td colspan="3">
                    <div class="text-justify">
                        <h3>Servicios Profesionales En Conputación</h3>
                        <p>Bo. Tierra Blanca, cuadras al norte del Museao Municipal, esquina opuesta a Ferreteria Valladares,
                            Danlí, El Paraíso
                        </p>
                        <p>Tel/fax: 2763-5610 Cel: 9993-3462 / 3310-3508</p>
                        <p><b>RTN: 07031978003476 - E-mail: sepcom2003@hotmail.com</b></p>
                        <p><b>De: DANIEL EDUARDO BUSTILLO GODOY</b></p>
                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: left" colspan="2"><p>Recibido por Honorarios: <b>{{ substr($factura->numero_factura, 0, 14) }}</b> <b style="color: red;font-size: 1rem">{{ substr($factura->numero_factura, 14, 19) }}</b>  </p></td>
                <td style="text-align: right" colspan="2"><b><i>Por Lps</i> <input readonly type="text" name="" id="" value="{{ $factura->precio }}"></b></td>
            </tr>
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


    <p>Recibi de: _______________<u>{{ $factura->cliente->Nombre. ' '. $factura->cliente->Apellido  }}</u>___________________RTN:_____________<u>{{ $factura->cliente->Numero_identidad }}</u>___________</p>
    <p>La suma neta de:___________<u>{{ $factura->total_numero_texto." lempiras" }}</u>_______________________________________</p>
    <br>
    <p>Por Concepto de:________________________________________________________________</p>
    <p><u>{{ $factura->descripcion }}</u></p>
    <p>_____<u>{{ Carbon\Carbon::parse( $factura->fecha_factura)->format('d') }}</u>____ de:__<u>{{ Carbon\Carbon::parse( $factura->fecha_factura)->formatLocalized('%B') }}</u>__Año <u>{{ Carbon\Carbon::parse( $factura->fecha_factura)->format('Y') }}</u></p>

    <div style="width: 100%; text-align: right">
        <p>Rango Autorizado: 000-001-004-{{  sprintf('%08d', $rangos->facturaInicial) }} A 000-001-004-{{  sprintf('%08d', $rangos->facturaFinal) }}</p>
        <p>Fecha Límite de Emisión: {{  $rangos->fechaVencimiento }}</p>
        <p>Gracias por su compra.</p>
    </div>

</body>
</html>

