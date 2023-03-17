<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Gasto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GastoController extends Controller
{
    //


        //Para mostrar el registro
    public function show (){
            $fecha_actual = Carbon::now()->format('Y-m-d');
            $empleados = Empleado::all();
            return view('Gastos.RegistroGastos')->with( 'fecha_actual', $fecha_actual )
                                                ->with('empleados',$empleados);
        }



        //Para Guadar
    public function store(Request $request){

        // pasamos los string parametros a arreglos
        $rules = ([
            'nombre_gasto' =>'required',
            'tipo_gasto' =>'required',
            'fecha_gasto' =>'required|date',
            'descripcion_gasto' =>'required|max:150',
            'total_gasto' => 'required|numeric',
            'responsable_gasto' =>'',

        ]);

        $this->validate($request, $rules);

        $gasto = new Gasto();
        $gasto->nombre_gasto = $request->input('nombre_gasto');
        $gasto->tipo_gasto = $request->input('tipo_gasto');
        $gasto->descripcion_gasto = $request->input('descripcion_gasto');
        $gasto->total_gasto = $request->input('total_gasto');
        $gasto->fecha_gasto = $request->input('fecha_gasto');
        $gasto->responsable_gasto = $request->input('responsable');

        $gasto->save();

        return redirect()->route('gasto.index')->with('mensaje', 'Se guardó  con  éxito');

    }

          //Para mostrar el listado
    public function index(){
        $gastos = Gasto::all();
        foreach ($gastos as $key => $gasto) {
            $gasto->responsable_gasto = Empleado::find( $gasto->responsable_gasto)->Nombres.' '.Empleado::find( $gasto->responsable_gasto)->Apellidos;
        }

        return view('Gastos.Listadodegastos')->with('gastos',$gastos);
    }

        //Para mostrar la informacion de detalle del listado
        public function mostrarGas($id){
            $gastos = Gasto::findOrFail($id);

            $gastos->responsable_gasto = Empleado::find( $gastos->responsable_gasto)->Nombres.' '.Empleado::find( $gastos->responsable_gasto)->Apellidos;

            return view('Gastos.InformacionGastos')->with('gastos',$gastos);

        }











}
