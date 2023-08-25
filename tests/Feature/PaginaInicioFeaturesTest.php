<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaginaInicioFeaturesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /*********** PRUEBA 1 *************/
    public function test_ingresar_pagina_principal_sin_autenticar(){
        $response = $this->get('/'); /*dashboard */
        $response->assertRedirect('/login');
    }
    /********************* PRUEBA #2  ( Acceder a la ruta autenticado)**********************/
       public function test_acceder_ruta_pagina_principal(){

        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /******** PRUEBA 3 ******/
    //MOSTRAR bienvenida
    public function test_mostrar_botones_menu(){
        $user = User::findOrFail(1);
        Auth::login($user);


        //hace una peticion a la ruta
        $response = $this->actingAs($user)->get('/');
        //se espera una respuesta exitoss
        $response->assertStatus(200);
        //se verifica que salgan los siguientes campos
        $response->assertSeeInOrder([
            'Clientes',
            'Empleados',
            'Proveedor',
            'Productos',
            'Compras',
            'Pedidos',
            'Inventario',
            'Servicios',
            'Rango factura',
            'Ventas',
            'Devolución garantía',
            'Gastos',
            'Usuarios',
            'Planilla',
            'Administrador',
        ]);
    }

    /****************** PRUEBA #4 (Prueba para mostrar quienes somos)*****************/
    public function test_mostrar_quienes_somos(){
        $user = User::findOrFail(1);
        Auth::login($user);


        //hace una peticion a la ruta
        $response = $this->actingAs($user)->get('/');
        //se espera una respuesta exitoss
        $response->assertStatus(200);
        //se verifica que salgan los siguientes campos
        $response->assertSeeInOrder([
            'Misión',
            'Visión',
            'Objetivos estrategicos'
        ]);
    }

    /********** PRUEBA 5 *********/
    //MOSTRAR VALORES
    public function test_mostrar_valores(){
        $user = User::findOrFail(1);
        Auth::login($user);


        //hace una peticion a la ruta
        $response = $this->actingAs($user)->get('/');
        //se espera una respuesta exitoss
        $response->assertStatus(200);
        //
        $response->assertSee('Valores');
        //se verifica que salgan los siguientes campos
        $response->assertSeeInOrder([
            'Responsabilidad',
            'Respeto',
            'Actitud de servicio',
            'Trabajo en equipo',
            'Mejora continua',
            'Confiabilidad'
        ]);
    }
    /****** PRUEBA 6 **************/
    //mostrar secciones
    //no pasa porque en Devolución por garantía tienen (Devolución por garantia)
    //les falto la tilde 
    public function test_mostrar_secciones(){
        $user = User::findOrFail(1);
        Auth::login($user);


        //hace una peticion a la ruta
        $response = $this->actingAs($user)->get('/');
        //se espera una respuesta exitoss
        $response->assertStatus(200);
        //
        //$response->assertSee('SECCIONES DE SERVI-SEPCOM');
        //se verifica que salgan los siguientes campos
        $response->assertSeeInOrder([
            'Clientes',
            'Empleados',
            'Proveedores',
            'Productos',
            'Compras',
            'Pedidos',
            'Inventario',
            'Servicios',
            'Rango de facturas',
            'Ventas',
            'Devolución por garantía',
            'Gastos',
            'Usuarios',
            'Planilla',
            'Inicio de sesión'
        ]);
    }
}
