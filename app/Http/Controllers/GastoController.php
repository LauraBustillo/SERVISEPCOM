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
            'nombre_gasto' =>'required|regex:/^([a-zñA-ZÑ]+)(\s[a-zñA-ZÑ]+)*$/|min:3|max:25',
            'tipo_gasto' =>'required',
            'fecha_gasto' =>'date',
            'descripcion_gasto' =>'required|max:150|min:5',
            'total_gasto' => 'required|numeric|min:2',
            'responsable_gasto'=> 'required',

        ]);
        $mesaje = ([
            'nombre_gasto.required' => 'El nombre del gasto es requerido',
            'nombre_gasto.min'=>'El nombre del gasto debe tener minimo 3 letras',
            'nombre_gasto.max'=>'El nombre del gasto no debe de tener más de 25 letras',
            'nombre_gasto.regex'=>'El nombre del gasto solo puede tener letras',

            'tipo_gasto.required' => 'El tipo de gasto es requerido',

            'fecha_gasto.required' => 'La fecha del gasto es requerida',

            'descripcion_gasto.required' => 'La descripción del gasto es requerida',
            'descripcion_gasto.min'=>'La descripción debe tener minimo 5 letras',

            'total_gasto.required' => 'El total del gasto es requerido',
            'total_gasto.numeric' => 'El total del gasto solo debe contener números',
            'total_gasto.min'=>'El total del gasto debe contener minimo 2 números',
            'total_gasto.max'=>'El total del gasto debe contener maximo 5 números',

            'responsable_gasto.required' => 'El responsable del gasto es requerido',



          ]);

        $this->validate($request, $rules, $mesaje);

        $gasto = new Gasto();
        $gasto->nombre_gasto = $request->input('nombre_gasto');
        $gasto->tipo_gasto = $request->input('tipo_gasto');
        $gasto->descripcion_gasto = $request->input('descripcion_gasto');
        $gasto->total_gasto = $request->input('total_gasto');
        $gasto->fecha_gasto = $request->input('fecha_gasto');
        $gasto->responsable_gasto = $request->input('responsable_gasto');

        $gasto->save();

        return redirect()->route('gasto.index')->with('mensaje', 'Se guardó  con  éxito');

    }

          //Para mostrar el listado
    public function index(){
        $gastos = Gasto::all();
        foreach ($gastos as $key => $gasto) {
            if ($gasto->responsable_gasto) {
                $gasto->responsable_gasto = Empleado::find( $gasto->responsable_gasto)->Nombres.' '.Empleado::find( $gasto->responsable_gasto)->Apellidos;
            }

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
