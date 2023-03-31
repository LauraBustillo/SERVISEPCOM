<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanillaDetalle extends Model
{
    use HasFactory;


    public function planilla()
    {
        return $this->belongsTo('App\Models\Planilla');
    }

    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado');
    }
}
