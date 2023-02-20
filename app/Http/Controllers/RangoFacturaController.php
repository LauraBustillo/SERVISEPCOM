<?php

namespace App\Http\Controllers;

use App\Models\RangoFactura;
use App\Http\Requests\StoreRangoFacturaRequest;
use App\Http\Requests\UpdateRangoFacturaRequest;
use App\Rules\FacturaFinalMayorQueInicial;
use App\Rules\FacturaFinalMayorQueInicialVentas;
use Illuminate\Http\Request;

class RangoFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rangos = RangoFactura::all()->sortByDesc('id');
        $rangoActual = RangoFactura::where('estado', '=', 1)->get();
        return view('rangofactura.lista')->with('rangos', $rangos)
            ->with('rangoActual', $rangoActual);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rangofactura.registrorangofactura');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRangoFacturaRequest  $request
     * @return \Illuminate\Http\Response
     */
    //Funcion para guadar
    public function store(Request $request)
    {


        $rules = ([
            'caiRango' => 'required|unique:rango_facturas|regex:^\b([0-9A-Fa-f]{6}-){5}[0-9A-Fa-f]{2}\b^|max:37',
            'fechaInicio' => 'required|before:fechaVencimiento',
            'fechaVencimiento' => 'required',
            'facturaInicial' => 'required|regex:^[0-9]-\d{3}-\d{2}-\d{8}$^|max:19',
            'facturaFinal' => ['required','regex:^[0-9]-\d{3}-\d{2}-\d{8}$^','max:19',new FacturaFinalMayorQueInicial()],

        ]);
        $mesaje = ([

            'caiRango.required' => 'El CAI es obligatorio',
            'caiRango.regex' => 'El numero CAI solo adminte valores hexadecimales (0-F)',
            'caiRango.unique' => 'El numero CAI ya ha sido usado',
            'fechaInicio.required' => 'La fecha de inicio es obligatoria',
            'fechaInicio.before' => 'La fecha de inicio debe de ser menor a la fecha de vencimiento',
            'fechaVencimiento.required' => 'La fecha final es obligatoria',
            'facturaInicial.required' => 'La factura inicial es obligatoria',
            'facturaFinal.required' => 'La factura final es obligatoria',
        ]);


        $this->validate($request, $rules, $mesaje);

        $actual = RangoFactura::where('estado', 1)->get();
        if(count($actual)>0){
            $actual[0]->estado = 0;
            $actual[0]->save();
        }



        $agregar = new RangoFactura();
        $agregar->fechaInicio = $request->input('fechaInicio');
        $agregar->fechaVencimiento = $request->input('fechaVencimiento');
        $agregar->facturaInicial = substr($request->input('facturaInicial'), -8);
        $agregar->facturaFinal =  substr($request->input('facturaFinal'), -8);
        $agregar->caiRango =  $request->input('caiRango');
        $agregar->facturaActual =  substr($request->input('facturaInicial'), -8);
        $agregar->ocupadas =  0;
        $agregar->facturaDisponibles = intval(substr($request->input('facturaFinal'), -8)) - intval(substr($request->input('facturaInicial'), -8));
        $agregar->estado =  1;
        $agregar->save();

        return redirect()->route('RangoFactura.index')->with('mensaje', 'Se guardó  con  éxito');
    }

    public function storeVentas(Request $request)
    {

        $rules = ([
            'fecha_desde' => 'required|before:fecha_hasta',
            'fecha_hasta' => 'required',
            'rango_hasta' => 'required|regex:^[0-9]-\d{3}-\d{2}-\d{8}$^|max:19',
            'rango_desde' => ['required','regex:^[0-9]-\d{3}-\d{2}-\d{8}$^','max:19',new FacturaFinalMayorQueInicialVentas()],
            'numero_cai' => 'required|regex:^\b([0-9A-Fa-f]{6}-){5}[0-9A-Fa-f]{2}\b^|max:37',
        ]);

        $mesaje = ([
            'fecha_desde.required' => 'La fecha de inicio es requerida',
            'fecha_desde.before' => 'La fecha de inicio debe de ser menor a la fecha de vencimiento',
            'fecha_hasta.required' => 'La fecha final es requerida',
            'rango_desde.required' => 'La factura iniciales requerida',
            'rango_hasta.required' => 'La factura final es requerida',
            'numero_cai.required' => 'El CAI es requerida',
            'numero_cai.regex' => 'El numero CAI solo adminte valores hexadecimales (0-F)',
        ]);

        $this->validate($request, $rules, $mesaje);


        $actual = RangoFactura::where('estado', 1)->first();
        if($actual){
            $actual->estado = 0;
            $actual->save();
        }

        $agregar = new RangoFactura();
        $agregar->fechaInicio = $request->input('fecha_desde');
        $agregar->fechaVencimiento = $request->input('fecha_hasta');
        $agregar->facturaInicial = substr($request->input('rango_desde'), -8);
        $agregar->facturaFinal =  substr($request->input('rango_hasta'), -8);
        $agregar->caiRango =  $request->input('numero_cai');
        $agregar->facturaActual =  substr($request->input('rango_desde'), -8);
        $agregar->ocupadas = 0;
        $agregar->facturaDisponibles =  intval(substr($request->input('rango_hasta'), -8)) - intval(substr($request->input('rango_desde'), -8));
        $agregar->estado = 1;
        $agregar->save();

        return redirect()->route('show.registroventa')->with('mensaje', 'Se guardó  con  éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RangoFactura  $rangoFactura
     * @return \Illuminate\Http\Response
     */
    public function show(RangoFactura $rangoFactura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RangoFactura  $rangoFactura
     * @return \Illuminate\Http\Response
     */
    public function edit(RangoFactura $rangoFactura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRangoFacturaRequest  $request
     * @param  \App\Models\RangoFactura  $rangoFactura
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRangoFacturaRequest $request, RangoFactura $rangoFactura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RangoFactura  $rangoFactura
     * @return \Illuminate\Http\Response
     */
    public function destroy(RangoFactura $rangoFactura)
    {
        //
    }
}
