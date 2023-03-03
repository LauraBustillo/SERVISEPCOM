<?php

namespace App\Http\Controllers;

use App\Models\Reparacion;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Garantia;
use App\Models\PiezaReparacione;
use App\Models\RangoFactura;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class ReparacionController extends Controller
{
    //


    public function index(Request $request)
    {
        $reparaciones = [];

        $reparaciones =  Reparacion::select('reparacions.*', 'clientes.Nombre', 'clientes.Apellido')
            ->join('clientes', 'clientes.id', '=', 'reparacions.cliente_id')->orderBy('created_at', 'DESC')->get();

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


        return view('Servicios.ListadoReparacion')->with('reparaciones', $reparaciones)
                                                  ->with('num_factura', $num_factura);
    }

    public function reparacion()
    {

        $accion = 'agregar';
        $reparacion = (object)array(
            "cliente_id" => "", "Nombre" => "", "Apellido" => "", "Numero_telefono" => "", "Numero_identidad" => "", "Direccion" => "",
            "numero_factura" => "", "fecha_facturacion" => "", "precio" => "", "descripcion" => "",
            "estado" => "", "numero_factura" => "", "fecha_factura" => "", "precio" => "", "descripcion" => "",
            "descripcionr" => "", "foto" => "", "foto1" => "", "foto2" => "", "foto3" => "", "foto4" => "",
            "cambio_pieza" => "", "garantia" => "", "categoria" => "", "nombre_equipo" => "", "marca" => "", "modelo" => "",
            "fecha_ingreso" => "", "fecha_entrega" => "", "categoria_producto_inv" => "", "marca_producto_inv" => "",
            "nombre_producto_inv" => "", "id_producto_inv" => "",
        );

        $clientes = DB::table('clientes')->orderBy('id', 'DESC')->get();

        $query = 'SELECT DISTINCT
                        p.id_product as id_producto,
                        cat.Descripcion as Categoria,
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


        $inventario = DB::select(DB::raw($query));


       // return json_encode($inventario);

        $piezas = [];
        return view('Servicios.RegistroReparacion')
            ->with('clientes', $clientes)
            ->with('reparacion', $reparacion)
            ->with('inventario', $inventario)
            ->with('accion', $accion)
            ->with('piezas', $piezas);
    }



    /*Funcion para  guardar  */
    public function guardar(Request $request)
    {


        $rules = ([

            'cliente_id' => 'required',
            'categoria' => 'required',
            'nombre_equipo' => 'required|regex:/^([a-zñA-ZÑ]+)(\s[a-zñA-ZÑ]+)*$/|min:4|max:20',
            'marca' => 'required|regex:/^([a-zñA-ZÑ0-9]+)(\s[a-zñA-ZÑ0-9]+)*$/|min:2|max:20',
            'modelo' => 'required|regex:/^([a-zñA-ZÑ0-9]+)(\s[a-zñA-ZÑ0-9]+)*$/|min:4|max:20',
            'descripcionr' => 'required|regex:/^([a-zñA-ZÑ0-9]+)(\s[a-zñA-ZÑ0-9]+)*$/|min:4|max:200',

            'foto' => 'required',
            'foto1',
            'foto2',
            'foto3',
            'foto4',
            'cambio_pieza',
            'garantia',

            'fecha_ingreso' => 'required',
            'fecha_entrega' => 'required',

        ]);
        $mesaje = ([

            'cliente_id.required' => 'Debe agregar un cliente',
            'categoria.required' => 'La categoría es requerida',


            'nombre_equipo.required' => 'El nombre del equipo es requerido',
            'nombre_equipo.regex' => 'El nombre del equipo solo debe tener letras',
            'nombre_equipo.min' => 'El nombre del equipo debe tener mínimo 4 letras',
            'nombre_equipo.max' => 'El nombre del equipo  no debe de tener más de 25 letras',

            'marca.required' => 'La marca es requerida',
            'marca.min' => 'La marca debe tener como mínimo 2 letras',
            'marca.max' => 'La marca no debe de tener más de 25 letras',
            'marca.regex' => 'La marca solo puede tener letras y números',

            'modelo.required' => 'El modelo es requerido',
            'modelo.regex' => 'El modelo solo puede tener letras y números',


            'descripcionr.required' => 'La descripción es requerido',
            'descripcionr.min' => 'La descripción debe tener como mínimo 4 letras',
            'descripcionr.max' => 'La descripción debede tener más de 15 letras',
            'descripcionr.regex' => 'La descripción solo puede tener letras y números',

            //FALTA
            'foto.required' => 'La foto es requerida',
            'cambio_pieza',
            'garantia',


            'fecha_ingreso.required' => 'La fecha de ingreso es requerida',

            'fecha_entrega.required' => 'La fecha de entrega es requerida',

        ]);

        $this->validate($request, $rules, $mesaje);

        $piezas = json_decode($request->input('datelles_piezas'));

        $agregar = new Reparacion();
        $agregar->cliente_id = $request->input('cliente_id');
        $agregar->estado =  'Pendiente';
        $agregar->categoria = $request->input('categoria');
        $agregar->nombre_equipo = $request->input('nombre_equipo');
        $agregar->marca = $request->input('marca');
        $agregar->modelo = $request->input('modelo');
        $agregar->descripcionr = $request->input('descripcionr');


        $agregar->foto = $request->input('foto');
        $agregar->foto1 = $request->input('foto1');
        $agregar->foto2 = $request->input('foto2');
        $agregar->foto3 = $request->input('foto3');
        $agregar->foto4 = $request->input('foto4');

        if ($request->switchGarantia) {
            $agregar->garantia = "Si";
        } else {
            $agregar->garantia = "No";
        }

        if ($request->switchCambioPieza) {
            $agregar->cambio_pieza = 'Si';
        } else {
            $agregar->cambio_pieza = "No";
        }

        $agregar->fecha_ingreso = $request->input('fecha_ingreso');
        $agregar->fecha_entrega = $request->input('fecha_entrega');
        $agregar1 =  $agregar->save();

        if ($request->switchGarantia) {
            $grantia = new Garantia();
            $grantia->id_reparacion = $agregar->id;
            $grantia->tipo_garantia = "Reparacion";
            $grantia->fecha_finalizacion = $request->input('final_garantia');
            $grantia->fecha_inicio = $request->input('inicio_garantia');
            $grantia->descripcion = $request->input('desc_garantia');
            $grantia->save();
        }

        if ($request->switchCambioPieza) {
            foreach ($piezas as $pieza) {
                $pz = new PiezaReparacione();
                $pz->id_producto = $pieza->id_producto;
                $pz->id_reparaciones =  $agregar->id;
                $pz->Marca = $pieza->Marca;
                $pz->Nombre_producto = $pieza->Nombre_producto;
                $pz->Categoria = $pieza->Categoria;
                $pz->Cantidad = $pieza->Cantidad;
                $pz->save();
            }
        }


        return redirect()->route('reparacion.index')->with('mensaje', 'Se guardó  con  éxito');
    }

    public function actualizarReparacion(Request $request, $id)
    {


        $piezas = json_decode($request->input('datelles_piezas'));


        $agregar = Reparacion::find($id);



        if ($request->switchestado_rep) {
            $agregar->estado = "Finalizado";
        } else {
            $agregar->estado = "Pendiente";
        }

        if ($request->switchCambioPieza) {
            $agregar->cambio_pieza = "Si";
        } else {
            $agregar->cambio_pieza = "No";
        }

        if ($request->switchGarantia) {
            $agregar->garantia = "Si";
        } else {
            $agregar->garantia = "No";
        }

        $agregar->fecha_entrega = $request->input('fecha_entrega');
        $agregar1 =  $agregar->save();


        DB::delete('delete from pieza_reparaciones where id_reparaciones = ?', [$id]);

        if ($request->switchCambioPieza) {
            foreach ($piezas as $pieza) {
                $pz = new PiezaReparacione();
                $pz->id_producto = $pieza->id_producto;
                $pz->id_reparaciones =  $agregar->id;
                $pz->Marca = $pieza->Marca;
                $pz->Nombre_producto = $pieza->Nombre_producto;
                $pz->Categoria = $pieza->Categoria;
                $pz->Cantidad = $pieza->Cantidad;
                $pz->save();
            }
        } else {
        }

        if ($request->switchGarantia) {

            $grantia = Garantia::where("id_reparacion", "=", $id)->get();
            if (isset($grantia[0]->id)) {
                $grantia = Garantia::findOrFail($grantia[0]->id);
            } else {
                $grantia = new Garantia();
                $grantia->id_reparacion = $agregar->id;
            }

            $grantia->fecha_finalizacion = $request->input('final_garantia');
            $grantia->fecha_inicio = $request->input('inicio_garantia');
            $grantia->descripcion = $request->input('desc_garantia');
            $grantia->save();
        } else {
        }



        return redirect()->route('reparacion.index');
    }


    /* Funcion para ver los detalles de reparacion */
    public function detallereparacion($id)
    {
        $products = [];
        $detalle = Reparacion::select(
            'clientes.Nombre as Nombre',
            'clientes.Apellido as Apellido',
            'clientes.Numero_identidad as Identidad',
            'clientes.Numero_telefono as Telefono',
            'clientes.Direccion as Direccion',
            'reparacions.*'
        )
            ->join('clientes', 'Clientes.id', '=', 'reparacions.cliente_id')
            ->where('reparacions.id', '=', $id)
            ->first();
        $Cliente = Cliente::all();

        $detalle->lista_piezas = PiezaReparacione::where('id_reparaciones', '=', $id)->get();
        $detalle->garantiass = Garantia::where('id_reparacion', '=', $id)->get();

        return view('Servicios.InformacionReparacion')
            ->with('products', $products)
            ->with('detalle', $detalle)
            ->with('Cliente', $Cliente);
    }

    public function mostrar($id)
    {

        $accion = 'editar';
        $clientes = [];
        $query = 'SELECT DISTINCT
        p.id_product as id_producto,
        cat.Descripcion as Categoria,
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


        $inventario = DB::select(DB::raw($query));

        $reparacion = Reparacion::select('reparacions.*', 'clientes.Nombre', 'clientes.Apellido', 'clientes.Numero_identidad', 'clientes.Numero_telefono', 'clientes.Direccion')
            ->join('clientes', 'clientes.id', '=', 'reparacions.cliente_id')
            ->where('reparacions.id', '=', $id)
            ->first();

        $piezas = PiezaReparacione::where("id_reparaciones", "=", $id)->get();
        $reparacion->garantiass = Garantia::where('id_reparacion', '=', $id)->get();


        // return json_encode($reparacion);

        return view('Servicios.RegistroReparacion')
            ->with('clientes', $clientes)
            ->with('reparacion', $reparacion)
            ->with('inventario', $inventario)
            ->with('accion', $accion)
            ->with('piezas', $piezas);
    }


    public function guardarFacturaReparacion(Request $request)
    {

        $rangos_cambio = true;
        $actu = Reparacion::find($request->input('id_r'));

        if($actu->numero_factura == $request->input('numero_facturaR')){
            $rangos_cambio = false;
        }else{
            $actu->numero_factura = $request->input('numero_facturaR');
        }

        $actu->fecha_factura = $request->input('fecha_facturacionR');
        $actu->precio = $request->input('precio_reparacion');
        $actu->descripcion = $request->input('descripcion_reparacion');


        if($rangos_cambio){
            $rangos = RangoFactura::where('estado', '=', 1)->get();


            $rango = RangoFactura::findOrFail($rangos[0]->id);
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
        }


         $actu->save();


        return redirect()->route('repacionones.ver', ['id'=>$actu->id])->with('mensaje','actualizado con exito');
    }

    public function factura_pdf($id)
    {
        $actu = Reparacion::find($id);
        $rango = RangoFactura::where('estado', '=', 1)->get();
        $rangos = RangoFactura::findOrFail($rango[0]->id);

        $digit = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $actu->total_numero_texto = $digit->format($actu->precio);
        $actu->cliente = Cliente::findOrFail($actu->cliente_id);

        $pdf = Pdf::loadView('facturaReparacion', [
            'factura' =>  $actu,
            'rangos' => $rangos
        ]);

        $pdf->setPaper('letter'); // Establecer tamaño de página como carta y orientación horizontal
        $pdf->setOption('margin-top', '5mm'); // Establecer margen superior en 5 mm
        $pdf->setOption('margin-bottom', '5mm'); // Establecer margen inferior en 5 mm
        $pdf->setOption('margin-left', '5mm'); // Establecer margen izquierdo en 5 mm
        $pdf->setOption('margin-right', '5mm'); // Establecer margen derecho en 5 mm
        $pdf->render();

        return $pdf->download('FacturaReparacion-'.$actu->numero_factura.'.pdf');
    }
}
