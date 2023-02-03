<?php

namespace App\Http\Controllers;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    //

    public function index(){
         return view('Ventas.Rangos');
    }
}
