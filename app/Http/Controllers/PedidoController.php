<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallesPedido;
use App\Models\Proveedor;
use App\Models\Product;
use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use Illuminate\Http\Request;
use DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
      
        $pedido =[];
        $buscar = '';

        if($request->buscar != null && $request->buscar != ''){
            $buscar = $request->buscar;
            $pedido = Pedido::where(DB::raw(('numero_pedido')),"like","%".strtolower($request->buscar)."%")
            ->orwhere('fecha_pedido', 'like','%'.strtolower($request->buscar).'%')->paginate(10); 
        }
        else{
            $buscar = '';
            $pedido = Pedido::paginate(10);
        }

        return view('pedido.ListadoPedidos')
        ->with('pedidos', $pedido)
        ->with('buscar',$buscar);

    }   



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $accion = 'crear';
        $detalles_pedido = [];
        $pedido = [];
        $proveedores = Proveedor::all();
        $proveedor = [];
        return view('Pedido.RegistroPedido')
        ->with('proveedores',$proveedores)
        ->with('proveedor',$proveedor)
        ->with('accion',$accion)
        ->with('pedido',$pedido)
        ->with('detalles_pedido',$detalles_pedido);
 
    }

    public function getProductosProv(Request $request)
    {   
        $productsProv = Product::select('id','Nombre_producto as text')->where('proveedor_id','=',$request->data)->get();
        echo $productsProv; 
    }
    public function getProductosDB(Request $request)
    {
        $product = Product::select('*')->where('id','=',$request->data)->first();
        echo $product; 
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePedidoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarPedido(Request $request)
    {
        $pedido = $request->data[0]; 
        $detallespedido = $request->data[1];

        // return $pedido['numero_pedido'];
        $p = new Pedido();
        $p -> numero_pedido = $pedido['numero_pedido'];
        $p -> fecha_pedido = $pedido['fecha_pedido'];
        $p -> id_proveedor = $pedido['id_proveedor'];
        $p -> estado = 0;
        $saved = $p->save();

        foreach ($detallespedido as $detalle) {       
            $dp = new DetallesPedido();
            $dp->id_detallepedido = $detalle['id_detallepedido'];
            $dp->numero_pedido = $pedido['numero_pedido'];
            $dp->id_producto = $detalle['id'];
            $dp->proveedor_id = $detalle['proveedor_id'];
            $dp->Cantidad = $detalle['Cantidad'];
            $dp->estado = 0;
            $saved = $dp->save();
        }   
        echo redirect()->route('index.pedido')->with('mensaje','Se guardó  con  éxito');

       
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $detalles_pedido = [];
        $proveedores = [];
        $accion = 'editar';

        $pedido =  Pedido::select('proveedors.Nombre_empresa as Proveedor','pedidos.*')
        ->join('proveedors', 'proveedors.id', '=', 'pedidos.id_proveedor')
        ->where('pedidos.id', '=',$id)
        ->first();

        $detalles_pedido = DetallesPedido::select('products.Nombre_producto','products.Marca','products.Descripcion','detalles_pedidos.*')
        ->join('products', 'products.id', '=', 'detalles_pedidos.id_producto')
        ->where('numero_pedido','=',$pedido->numero_pedido)->get();

        $proveedor = Proveedor::where('id','=',$pedido->id_proveedor)->first();


        return view('Pedido.RegistroPedido')
        ->with('proveedores',$proveedores)
        ->with('proveedor',$proveedor)
        ->with('accion',$accion)
        ->with('pedido',$pedido)
        ->with('detalles_pedido',$detalles_pedido);
    }

    public function guardarDetallePedido(Request $request)
    {
        $detalle = $request->data;

        $dp = new DetallesPedido();
        $dp->id_detallepedido = $detalle['id_detallepedido'];
        $dp->numero_pedido = $detalle['numero_pedido'];
        $dp->id_producto = $detalle['id'];
        $dp->proveedor_id = $detalle['proveedor_id'];
        $dp->Cantidad = $detalle['Cantidad'];
        $dp->estado = 0;
        $saved = $dp->save();
        echo $saved;
    }
    public function eliminarDetallePedido(Request $request)
    {
        DetallesPedido::where('id_detallepedido',$request->data)->delete();  
        return "succes";
    }
    
    public function actualizarPedido(Request $request)
    {
        $actu = Pedido::find($request->data['id']);
        $actu -> fecha_recibido = $request -> data['fecha_recibido_pedido'];
        $actu -> estado = $request -> data['estado_recibido'];
        $agregar1 =  $actu->save();
        return  $agregar1;

        if ($agregar1){
            return redirect()->route('index.pedido')->with('mensaje','se actualizó exitosamente') ;
         } else {
         
        }
    }

    public function detallepedido($id){
        $detalles_pedido = [];
        $pedido =  Pedido::select('proveedors.Nombre_empresa as Proveedor', 
        'proveedors.Nombre_encargado', 'proveedors.Correo', 'proveedors.Telefono_encargado','pedidos.*')
        ->join('proveedors', 'proveedors.id', '=', 'pedidos.id_proveedor')
        ->where('pedidos.id', '=',$id)
        ->first();
        $detalles_pedido = DetallesPedido::select('products.Nombre_producto','products.Marca','products.Descripcion','detalles_pedidos.*')
        ->join('products', 'products.id', '=', 'detalles_pedidos.id_producto')
        ->where('numero_pedido','=',$pedido->numero_pedido)->get();
        $detallefactura = DetallesPedido::where('numero_pedido','=',$pedido->numero_pedido)->get();
    
    
        return view('pedido.InformacionPedido')
        ->with('pedido',$pedido)
        ->with('detallefactura',$detallefactura)
        ->with('detalles_pedido',$detalles_pedido);
       }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePedidoRequest  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
