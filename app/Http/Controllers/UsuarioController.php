<?php

namespace App\Http\Controllers;

use App\Http\Permiso;
use App\Models\Empleado;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UsuarioController extends Controller
{

    public function index(Request $request)
    {
        Permiso::validarRolSoloAdmin(Auth::user());
        $usuarios = User::all();
        foreach ($usuarios as $key => $usuario) {
            if ($usuario->id_empleado) {
                $usuario->id_empleado = Empleado::find( $usuario->id_empleado)->Nombres.' '.Empleado::find( $usuario->id_empleado)->Apellidos;
            }
        }
        return view('Usuarios.ListadoUsuario')->with('usuarios',$usuarios);
    }


    public function show(){

        Permiso::validarRolSoloAdmin(Auth::user());

        $empleados = Empleado::all();


        return view('Usuarios.RegistrarUsuario')->with('empleados',$empleados);
    }


    public function store(Request $request)
    {

        Permiso::validarRolSoloAdmin(Auth::user());

        $rules= ([
            //'name' => ['required', 'string', 'max:255'],
'name' => ['required', 'string', 'max:100'],
            'id_empleado' => ['required', 'unique:users'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8','same:password'],
            'rol_usuario' => ['required'],
        ]);

        $message = ([

            'id_empleado.required'=>'Selecione un empleado',
            'id_empleado.unique'=>'El empleado ya está registrado',

            'name.required'=>'El usuario es obligatorio',
'name.string'=>'El nombre debe ser una cadena de texto.',
'name.max'=>'El nombre no puede tener más de 100 caracteres.',

            'email.required'=>'El correo es obligatorio',
            'email.unique'=>'El correo ya esta en uso',
'email.string' => 'El correo debe ser una cadena de texto.',
'email.email' => 'El formato del correo no es válido.',
'email.max' => 'El correo no puede tener más de 100 caracteres.',

            'password.required'=>'La contraseña es obligatoria',
            'password.min'=>'La contraseña debe tener minimo 8 caracteres',

            'password_confirmation.required'=>'Debe confirmar la contraseña',
            'password_confirmation.min'=>'La contraseña debe tener minimo 8 caracteres',
            'password_confirmation.same'=>'La contraseña deben coincidir con al confirmacion',

            'rol_usuario.required'=>'Selecione un rol',

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

        $rol = Role::create([
            'tipo' => $request->input('rol_usuario'),
            'id_usuario' =>  $user->id,
        ]);


        return redirect()->route('index.usuario')->with('mensaje', 'Se guardó  con  éxito');
    }



}
