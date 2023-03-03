<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\DetalleVenta;
use App\Models\DevolucionVenta;
use App\Models\Product;
use App\Models\Proveedor;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevolucionVentaController extends Controller
{
    //

    //Para mostrar el listado
    public function index()
    {
        $devoluciones = DevolucionVenta::all();

        foreach ($devoluciones as $key => $value) {
            $value->producto = Product::findOrFail($value->id_productos);
            $detalle = DetalleVenta::where('id_detalle','=',$value->id_detalle_venta)->get();
            $value->detalle_venta = DetalleVenta::findOrFail($detalle[0]->id);

        }


        return view('DevolucionesGarantiaVenta.ListadoDevolucionGarantia')
                ->with('devoluciones',$devoluciones);

    }

    //Para mostrar el registro
    public function show (){
        $ventas = [];
        $buscar = '';
        $fecha_actual = Carbon::now()->format('Y-m-d');

        $ventas = DB::table('Ventas')
        ->select('*')
        ->where('numeroFactura', "like", "%" . $buscar . "%")
        ->orWhere("fechaFactura", "like", "%" . $buscar . "%")
        ->orWhere("clienteFactura", "like", "%" . $buscar . "%")
        ->get();


        foreach ($ventas as $key => $value) {
            $value->detalles = DetalleVenta::where("Numero_facturaform","=", $value->numeroFactura)->get();
            foreach ($value->detalles as $key => $value2) {
                $producto = Product::findOrFail($value2->id_product);
                $categori = Categoria::findOrFail($value2->id_cat);
                $proveedor = Proveedor::findOrFail($producto->proveedor_id);
                $value2->Categoria = $categori->Descripcion;
                $value2->Proveedor = $proveedor->Nombre_empresa;

            }
        }


        return view('DevolucionesGarantiaVenta.RegistroDevolucionesGarantia')->with('ventas', $ventas)
                                                                            ->with('buscar', $buscar)
                                                                            ->with( 'fecha_actual', $fecha_actual  );
    }

    public function store(Request $request)
    {
        $rules = ([
            'id_producto_devolucion',
            'id_detalle_venta' =>'required',
            'fechaDev' =>'required|date',
            'des_devolucion' =>'required|max:255',
            'switchDev'
        ]);
 
        $mesaje=([
            //'id_producto_devolucion.required'=>'El producto es obligatorio' ,
            'id_detalle_venta.required'=>'El producto es obligatorio' ,
            'fechaDev.required'=>'La fecha de la devolucion es obligatoria' ,
            'fechaDev.date'=>'La fecha de la devolucion debe ser una fecha' ,
            'des_devolucion.required'=>'La descripción es obligatorio' ,
            'des_devolucion.max'=>'La descripción no debe superar los 255 caracteres' ,
        ]);

        $this->validate($request, $rules, $mesaje);

        $devolucion = new DevolucionVenta();
        $devolucion->id_productos = $request->input('id_producto_devolucion');
        $devolucion->id_detalle_venta = $request->input('id_detalle_venta');
        $devolucion->Descripcion = $request->input('des_devolucion');
        $devolucion->Fecha_devolucion = $request->input('fechaDev');

        if($request->switchDev){
            $devolucion->estado_devolucion = 'Realizado' ;
        }else{
            $devolucion->estado_devolucion = 'Pendiente' ;
        }

        $devolucion->save();

        return redirect()->route('devolucion.index')->with('mensaje', 'Se guardó  con  éxito');
    }






     //Para mostrar la informacion de detalle del listado
    public function mostrarDev($id)
    {

        $devoluciones = DevolucionVenta::findOrFail($id);

        $devoluciones->producto = Product::findOrFail($devoluciones->id_productos);
        $devoluciones->Categoria = Categoria::findOrFail($devoluciones->producto->categoria_id);
        $devoluciones->Proveedor = Proveedor::findOrFail($devoluciones->producto->proveedor_id);
        $detalle = DetalleVenta::where('id_detalle','=',$devoluciones->id_detalle_venta)->get();
        $devoluciones->detalle_venta = DetalleVenta::findOrFail($detalle[0]->id);
        $venta = Venta::where('numeroFactura','=',$detalle[0]->Numero_facturaform)->get();
        $devoluciones->venta = Venta::findOrFail($venta[0]->id);

        return view('DevolucionesGarantiaVenta.InformacionDevolucion')
                    ->with('devoluciones',$devoluciones);
    }


    //Para mostrar lo de editar del listado
    public function actualizarDev(Request $request,$id)
    {
        $devolucion = DevolucionVenta::findOrFail($id);
        if($request->check){
            $devolucion->estado_devolucion = 'Realizado' ;
        }else{
            $devolucion->estado_devolucion = 'Pendiente' ;
        }
        $devolucion->save();

        return redirect()->route('devolucion.index');
    }

    public function actu (){


        return view('DevolucionesGarantiaVenta.devolucion.index');


    }

}
