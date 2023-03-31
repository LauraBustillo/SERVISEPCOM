<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public function planilla_detalle()
    {
        return $this->hasOne('App\Models\DetalleCompra');
    }
}
