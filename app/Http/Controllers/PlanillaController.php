<?php

namespace App\Http\Controllers;

use App\Http\Permiso;
use App\Models\Empleado;
use App\Models\Planilla;
use App\Models\PlanillaDetalle;
use App\Rules\MaxDaysOfMonth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanillaController extends Controller
{
    //

    //Para mostrar el registro
    public function show()
    {
        Permiso::validarRolSoloAdmin(Auth::user());

        $planilla_existente = Planilla::where('fecha_final', '=', now('America/Tegucigalpa')->endOfMonth()->format('Y-m-d'))->where('estado', '=', 'G')->get();

        if (count($planilla_existente) > 0) {
            return redirect()->route('index.planilla')->with('mensaje', 'Ya hay planilla guardada para este mes');
        }

        try {
            DB::beginTransaction();

            $planilla = Planilla::where('fecha_final', '=', now('America/Tegucigalpa')->endOfMonth()->format('Y-m-d'))->where('estado', '=', 'N')->get();



            if (count($planilla) == 0) {
                $planilla = new Planilla();
                $planilla->fecha_inicio = now('America/Tegucigalpa')->format('Y-m-d');
                $planilla->fecha_final = now('America/Tegucigalpa')->endOfMonth()->format('Y-m-d');
                $planilla->total_pagar = 0;
                $planilla->estado = 'N';
                $planilla->save();

                $empleados = Empleado::where('activo', '=', 1)->get();

                foreach ($empleados as $key => $value) {
                    $detalle_planilla = new PlanillaDetalle();
                    $detalle_planilla->planilla_id =  $planilla->id;
                    $detalle_planilla->empleado_id =  $value->id;
                    $detalle_planilla->salario_hora =  (intval($value->Salrio) / 30) / 8;
                    $detalle_planilla->no_trabajados =  0;
                    $detalle_planilla->horas_diurnas =  0;
                    $detalle_planilla->horas_nocturnas =  0;
                    $detalle_planilla->save();
                }
            } else {
                $planilla = Planilla::findOrFail($planilla[0]->id);
                $deta = PlanillaDetalle::where('planilla_id', '=', $planilla->id)->get();
                $empleados = Empleado::where('activo', '=', 1)->get();

                if (count($empleados) > count($deta)) {
                    foreach ($empleados as $key => $value) {
                        $de = PlanillaDetalle::where('planilla_id', '=', $planilla->id)->where('empleado_id', '=', $value->id)->get();
                        if (count($de) == 0) {
                            $detalle_p = new PlanillaDetalle();
                            $detalle_p->planilla_id =  $planilla->id;
                            $detalle_p->empleado_id =  $value->id;
                            $detalle_p->salario_hora =  (intval($value->Salrio) / 30) / 8;
                            $detalle_p->no_trabajados =  0;
                            $detalle_p->horas_diurnas =  0;
                            $detalle_p->horas_nocturnas =  0;
                            $detalle_p->save();
                        }
                    }
                }

                if (count($empleados) < count($deta)) {
                    foreach ($deta as $key => $value) {
                        $de = Empleado::findOrFail($value->empleado_id);
                        if ($de->activo == 0) {
                            DB::delete('delete from planilla_detalles where id = ?', [$value->id]);
                        }
                    }
                }

                $planilla = Planilla::findOrFail($planilla->id);
            }
            DB::commit();


            return view('Planilla.RegistroPlanilla', ['planilla' => $planilla]);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('mensaje', $e->getMessage());
        }
    }

    //Para mostrar el listado

    public function index()
    {

        Permiso::validarRolSoloAdmin(Auth::user());

        $planilla = Planilla::where('fecha_final', '=', now('America/Tegucigalpa')->endOfMonth()->format('Y-m-d'))->where('estado', '=', 'N')->get();

        $listaPlanillas = Planilla::where('estado', '=', 'G')->get();


        if (count($planilla) == 0) {
            $continuar = false;
        } else {
            $continuar = true;
        }


        return view('Planilla.Listadoplanilla', ['continuar' =>  $continuar, 'listaPlanillas' => $listaPlanillas]);
    }


    //Horas no trabajadas
    public function restar_horas(Request $request)
    {

        $rules = ([
            'id_detalle' => 'required',
            'no_trabajo' => ['required', 'integer', new MaxDaysOfMonth, 'min:0'],
        ]);


        $mesaje = ([
            'id_detalle.required' => 'El id del detalle es obligatorio',
            'no_trabajo.required' => 'Los dias son obligatorios',
            'no_trabajo.min' => 'Los dias no pueden ser negativos',
        ]);

        $this->validate($request, $rules, $mesaje);

        $detalle = PlanillaDetalle::find($request->input('id_detalle'));
        $detalle->no_trabajados = $request->input('no_trabajo');
        $detalle->save();

        return redirect()->back();
    }

    //Horas no trabajadas
    public function diurnas_horas(Request $request)
    {

        $rules = ([
            'id_detalle' => 'required',
            'no_trabajo' => ['required', 'integer', 'min:0'],
        ]);


        $mesaje = ([
            'id_detalle.required' => 'El id del detalle es obligatorio',
            'no_trabajo.required' => 'Las horas son obligatorios',
            'no_trabajo.min' => 'Las horas no pueden ser negativos',
        ]);

        $this->validate($request, $rules, $mesaje);

        $detalle = PlanillaDetalle::find($request->input('id_detalle'));
        $detalle->horas_diurnas = $request->input('no_trabajo');
        $detalle->save();

        return redirect()->back();
    }

    //Horas no trabajadas
    public function nocturnas_horas(Request $request)
    {

        $rules = ([
            'id_detalle' => 'required',
            'no_trabajo' => ['required', 'integer', 'min:0'],
        ]);


        $mesaje = ([
            'id_detalle.required' => 'El id del detalle es obligatorio',
            'no_trabajo.required' => 'Las horas son obligatorios',
            'no_trabajo.min' => 'Las horas no pueden ser negativos',
        ]);

        $this->validate($request, $rules, $mesaje);

        $detalle = PlanillaDetalle::find($request->input('id_detalle'));
        $detalle->horas_nocturnas = $request->input('no_trabajo');
        $detalle->save();

        return redirect()->back();
    }

    //borrar Planilla
    public function eliminar_planilla($id)
    {

        DB::delete('delete from planilla_detalles where planilla_id = ?', [$id]);
        Planilla::destroy($id);

        return redirect()->back();
    }

    public function guardar_planilla(Request $request, $id)
    {
        $planilla = Planilla::find($id);
        $planilla->estado = 'G';
        $planilla->total_pagar = $request->input('total_planilla');
        $planilla->save();

        return redirect()->back();
    }




    // Para mostrar la informacion
    public function mostrar($id)
    {
        $planillaI = Planilla::findOrFail($id);
        $planillaDetalle = PlanillaDetalle::where("planilla_id","=",$id)->get();
        
        return view('Planilla.InformacionPlanilla')->with('planillaI', $planillaI)->with('planillaDetalle', $planillaDetalle);
    }
}
