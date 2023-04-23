<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    
    use HasFactory;
    

    public function clientes(){
        return $this-> belongsTo(Cliente::class, 'cliente_id');
     }
}