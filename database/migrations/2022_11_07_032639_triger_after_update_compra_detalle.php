<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrigerAfterUpdateCompraDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER compra_detalles_after_update AFTER UPDATE ON `compra_detalles` FOR EACH ROW
        BEGIN



        INSERT INTO historial_precios (
        num_factura,
        fecha_cambio,
        id_producto,
        precio_antiguo,
        costo_antiguo,
        precio_nuevo,
        costo_nuevo,
        created_at,
        updated_at
        
        )
    
        VALUES
    
        (
        
        new.Numero_facturaform,
        NOW(),
        new.id_product,
        IFNULL((SELECT h.precio_nuevo FROM historial_precios AS h WHERE h.id_producto = new.id_product ORDER BY h.fecha_cambio DESC LIMIT 1),0),
        IFNULL((SELECT h.costo_nuevo FROM historial_precios AS h WHERE h.id_producto = new.id_product ORDER BY h.fecha_cambio DESC LIMIT 1),0),
        NEW.Precio_venta,
        NEW.Costo,
        NOW(),
        NOW()
        
        );
    END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `compra_detalles_after_update`');
        
    }
}
