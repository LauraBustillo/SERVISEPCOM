<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function show(){

        $empleados = Empleado::all();

        return view('Usuarios.RegistrarUsuario')->with('empleados',$empleados);
    }


    public function store(Request $request)
    {

        $rules= ([
            'name' => ['required', 'string', 'max:255'],
            'id_empleado' => ['required', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $message = ([

            'id_empleado.required'=>'Selecione un empleado',
            'id_empleado.unique'=>'El empleado ya está registrado',

            'name.required'=>'El usuario es obligatorio',

            'imail.required'=>'El correo es obligatorio',
            'imail.unique'=>'El correo ya esta en uso',

            'password.required'=>'La contraseña es obligatoria',
            'password.confirmed'=>'Debe confirmar la contraseña',
            'password.min'=>'La contraseña debe tener minimo 8 caracteres',



        ]);

        $this->validate($request, $rules, $message);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'id_empleado' => $request->input('id_empleado'),
           // 'ciudad_nacimiento' => $request->input('ciudad_nacimiento'),
            //'color_favo' => $request->input('color_favo'),
        ]);

        return redirect()->route('show.registroUsuarios');
    }



}
