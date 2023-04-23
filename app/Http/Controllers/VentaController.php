<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Garantia;
use App\Models\RangoFactura;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class VentaController extends Controller
{

    public function index(Request $request)
    {  

        $ventas = [];
        $buscar = '';


        if ($request->buscar != null && $request->buscar != '') {
            $buscar = $request->buscar;
            //$ventas =  Venta::where(DB::raw ('numeroFactura'), "like","%".strtolower($request->buscar)."%")
            //->orwhere('fechaFactura', 'like','%'.strtolower($request->buscar).'%')->paginate(10); --}}

        }
        // $buscar = '';
        //$ventas = Venta::paginate(10);

        $ventas = DB::table('Ventas')
            ->select('*')
            ->where('numeroFactura', "like", "%" . $buscar . "%")
            ->orWhere("fechaFactura", "like", "%" . $buscar . "%")
            ->orWhere("clienteFactura", "like", "%" . $buscar . "%")
            ->get();


        return view('Ventas.ListadoVenta')->with('ventas', $ventas)->with('buscar', $buscar);
    }



    public function show()
    {

        /* La consulta está buscando todos los registros
            donde el campo estado tenga el valor 1.
            La consulta devuelve una colección de objetos RangoActura y
            se asigna a la variable $rangos. */
        $rangos = RangoFactura::where('estado', '=', 1)->get();



        /* La función sprintf permite formatear una
            cadena de texto con valores específicos.
            El formato especificado en el código es %08d,
            que significa que se quiere formatear un número con un
            total de 8 dígitos, rellenando con ceros a la
            izquierda si es necesario para cumplir con la longitud. formato estandar de la SAR:
            000-000-00-00000000*/
        if (count($rangos)) {
            $num_factura = '000-001-04-' . sprintf('%08d', $rangos[0]->facturaActual);
        } else {
            $num_factura = '';
        }


        $cliente = Cliente::all();

        //Select que rebaja el inventario tanto de detalle de ventas como de piezas en las reparaciones
        $query = 'SELECT DISTINCT
                        p.id_product,
                        cat.id as id_cat,
                        prov.id as id_prov,
                        p.Nombre_producto,
                        p.Descripcion,
                        p.Marca,
                        (SELECT MAX(costo) FROM compra_detalles WHERE compra_detalles.id_product = p.id_product) as costo,
                        (SELECT MAX(Precio_venta) FROM compra_detalles WHERE compra_detalles.id_product = p.id_product) as Precio_venta,
                        ((SELECT SUM(Cantidad) FROM compra_detalles WHERE compra_detalles.id_product = p.id_product) -
                                if((SELECT SUM(Cantidad) FROM detalle_ventas WHERE detalle_ventas.id_product = p.id_product) IS NULL,
                                            0, (SELECT SUM(Cantidad) FROM detalle_ventas WHERE detalle_ventas.id_product = p.id_product))
                                            -
                                if((SELECT SUM(Cantidad) FROM pieza_reparaciones WHERE pieza_reparaciones.id_producto = p.id_product) IS NULL,
                                            0, (SELECT SUM(Cantidad) FROM pieza_reparaciones WHERE pieza_reparaciones.id_producto = p.id_product))
                        ) as Cantidad,
                        p.Impuesto,
                        prov.Nombre_empresa,
                        cat.Descripcion as DescripcionC
                FROM compra_detalles AS p
                INNER JOIN proveedors  as prov ON p.id_prov = prov.id
                INNER JOIN categorias AS cat ON p.id_cat = cat.id';


        $products = DB::select(DB::raw($query));

        $detallefactura = [];
        $accion = 'guardar';

        return view('Ventas.RegistroVentas', [
            'num_factura' => $num_factura,
            'fecha_actual' => Carbon::now()->setTimezone('America/Tegucigalpa')->format('Y-m-d'),
            'rangoActual' =>  $rangos,
            'clientes' =>  $cliente,
            'products' =>  $products,
            'detallefactura' =>  $detallefactura,
            'accion' =>  $accion
        ]);
    }


    public function store($arrayFac, $arrayDet)
    {
        // pasamos los string parametros a arreglos
        $jsonFactura =  json_decode($arrayFac);
        $arrayDetallesFac =  json_decode($arrayDet);

        $venta =  new Venta();

        $venta->numeroFactura = $jsonFactura->numeroFactura;
        $venta->empleadoVentas = $jsonFactura->empleadoVentas;
        $venta->fechaFactura = $jsonFactura->fechaFactura;
        $venta->clienteFactura = $jsonFactura->clienteFactura;
        $venta->totalFactura = $jsonFactura->Total_factura;
        $venta->idRangoFactura = $jsonFactura->id_rango;
        $venta->save();


        foreach ($arrayDetallesFac as $detFact) {
            $a = new DetalleVenta();
            $a->id_detalle = $detFact->id_detalle;
            $a->Numero_facturaform = $jsonFactura->numeroFactura;
            $a->id_cliente = $jsonFactura->clienteFactura;
            $a->id_product = $detFact->id_product;
            $a->nombre_producto = $detFact->nombre_producto;
            $a->Descripcion = $detFact->Descripcion;
            $a->Marca = $detFact->Marca;
            $a->id_cat = $detFact->id_cat;
            $a->Cantidad = $detFact->Cantidad;
            $a->Costo = $detFact->Costo;
            $a->Precio_venta = $detFact->Precio_venta;
            $a->Impuesto = $detFact->Impuesto;
            $agregar1 =  $a->save();
        }


        $rango = RangoFactura::findOrFail($jsonFactura->id_rango);
        $rango->facturaActual += 1;
        $rango->ocupadas += 1;
        $rango->facturaDisponibles -= 1;

        if ($rango->facturaActual > $rango->facturaFinal) {
            $rango->estado = 0;
        }

        $fechaActual = Carbon::now()->setTimezone('America/Tegucigalpa');

        if ($fechaActual->gt(Carbon::parse($rango->fechaVencimiento)->setTimezone('America/Tegucigalpa'))) {
            $rango->estado = 0;
        }

        $rango->save();

        if ($jsonFactura->garantia == 'si') {
            $grantia = new Garantia();
            $grantia->id_reparacion = $venta->id;
            $grantia->tipo_garantia = "Ventas";
            $grantia->fecha_finalizacion = Carbon::parse($jsonFactura->fechaFactura)->setTimezone('America/Tegucigalpa')->addDays(30)->format('Y-m-d');
            $grantia->fecha_inicio = $jsonFactura->fechaFactura;
            $grantia->descripcion = 'Garantia general de los productos ofrecidos por la empresa';
            $grantia->save();
        }


        return redirect()->route('venta.mostrar',['id'=> $venta->id])->with('mensaje', 'Se guardó  con  éxito');
    }
  
    public function mostrar($id)
    {
        $products = [];
        $factura = Venta::findOrFail($id);
        $detallefactura = DetalleVenta::where('Numero_facturaform', '=', $factura->numeroFactura)->get();
        $rangos = RangoFactura::findOrFail($factura->idRangoFactura);
        $garantia = Garantia::where('tipo_garantia','=','Ventas')->where('id_reparacion','=',$id)->get();


        return view('Ventas.InformacionVenta')
            ->with('products', $products)
            ->with('factura', $factura)
            ->with('detallefactura', $detallefactura)
            ->with('rangos', $rangos)
            ->with('garantia', $garantia);
    }

    public function factura_pdf($id)
    {
        $factura = Venta::findOrFail($id);
        $digit = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $factura->total_numero_texto = $digit->format($factura->totalFactura);
        $factura->numero_identidad = Cliente::whereRaw('concat(Nombre," ",Apellido) = "'.$factura->clienteFactura.'"')->get()[0]->Numero_identidad;
        $detallefactura = DetalleVenta::where('Numero_facturaform', '=', $factura->numeroFactura)->get();
        $rangos = RangoFactura::findOrFail($factura->idRangoFactura);

        $pdf = PDF::loadView('factura', [
            'factura' => $factura,
            'detallefactura' => $detallefactura,
            'rangos' => $rangos
        ]);

        $pdf->setPaper('letter'); // Establecer tamaño de página como carta y orientación horizontal
        $pdf->setOption('margin-top', '5mm'); // Establecer margen superior en 5 mm
        $pdf->setOption('margin-bottom', '5mm'); // Establecer margen inferior en 5 mm
        $pdf->setOption('margin-left', '5mm'); // Establecer margen izquierdo en 5 mm
        $pdf->setOption('margin-right', '5mm'); // Establecer margen derecho en 5 mm
        $pdf->render();


        $pdf->save(public_path('pdf\Factura-'.$factura->numeroFactura.'.pdf'));


        return view('factura', [
            'factura' => $factura,
            'detallefactura' => $detallefactura,
            'rangos' => $rangos
        ]);

    }

    public function garantia_pdf($id)
    {
        $factura = Venta::findOrFail($id);

        $factura->numero_identidad = Cliente::whereRaw('concat(Nombre," ",Apellido) = "'.$factura->clienteFactura.'"')->get()[0]->Numero_identidad;
        $detallefactura = DetalleVenta::where('Numero_facturaform', '=', $factura->numeroFactura)->get();
        $rangos = RangoFactura::findOrFail($factura->idRangoFactura);

        $pdf = PDF::loadView('facturaGarantia', [
            'factura' => $factura,
            'detallefactura' => $detallefactura,
            'rangos' => $rangos
        ]);

        $pdf->setPaper('letter'); // Establecer tamaño de página como carta y orientación horizontal
        $pdf->setOption('margin-top', '5mm'); // Establecer margen superior en 5 mm
        $pdf->setOption('margin-bottom', '5mm'); // Establecer margen inferior en 5 mm
        $pdf->setOption('margin-left', '5mm'); // Establecer margen izquierdo en 5 mm
        $pdf->setOption('margin-right', '5mm'); // Establecer margen derecho en 5 mm
        $pdf->render();

        $pdf->save(public_path('GarntiaVenta-'.$factura->numeroFactura.'.pdf'));



        return view('facturaGarantia', [
            'factura' => $factura,
            'detallefactura' => $detallefactura,
            'rangos' => $rangos
        ]);
    }

}
