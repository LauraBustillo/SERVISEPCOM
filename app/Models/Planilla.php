<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;

    public function planilla_detalle()
    {
        return $this->hasMany('App\Models\PlanillaDetalle');
    }
}
