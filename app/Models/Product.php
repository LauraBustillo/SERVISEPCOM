<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function proveedors(){
        return $this-> belongsTo(Proveedor::class, 'proveedor_id');
     }

     public function categorias(){
        return $this-> belongsTo(Categoria::class, 'categoria_id');
     }

     public function historial(){
      return $this-> hasMany(HistorialPrecio::class);
  }
}
