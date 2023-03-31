<?php

namespace App\Http;

use App\Models\Role;

class Permiso {

    public static $desicion = false;

    public static $roles = [
        'Administrador',
        'Empleado'
    ];

    public static function traerRol($user) {
        $rol = Role::where('id_usuario','=',$user->id)->get();
        return $rol[0]->tipo;
    }

    public static function traerRolUsuarios($user) {
        $rol = Role::where('id_usuario','=',$user->id)->get();
        if(!isset($rol[0])){
            return 'No tiene rol';
        }
        return $rol[0]->tipo;
    }



    public static function validarRolSoloAdmin($user) {

        if(self::traerRol($user) == self::$roles[0]){
            self::$desicion = false;
        }else{
            self::$desicion = true;
        }

        abort_if(self::$desicion, redirect()->route('dashboard')->with('denegar','No tiene acceso a esta seccion'));
    }


    public static function validarRolEmpleadoyAdmin($user) {

        if(self::traerRol($user)  == self::$roles[1] && self::traerRol($user)  == self::$roles[0] ){
            self::$desicion = false;
        }else{
            self::$desicion = true;
        }

        abort_if(self::$desicion, redirect()->route('dashboard')->with('denegar','No tiene acceso a esta seccion'));
    }



}
