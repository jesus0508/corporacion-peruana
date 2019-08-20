<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //triggers SALDO TOTAL PROVEEDOR
        //CREATE PEDIDO
        DB::unprepared('

        CREATE TRIGGER saldo_proveedor_up
            AFTER INSERT 
            ON `pedidos` FOR EACH ROW
            BEGIN 
                DECLARE id_proveedor int;
                DECLARE id_planta int;
                DECLARE monto float;
    
                set id_planta = NEW.planta_id;
                select `proveedor_id` into id_proveedor 
                    from `plantas` where `id`=id_planta;
                set monto = NEW.costo_galon * NEW.galones ;
    
                UPDATE `proveedores` set `deuda` = `deuda` + round( monto , 2)
                WHERE `id` = id_proveedor ;
            END;
        ');
        //DELETE PEDIDO
        DB::unprepared('

        CREATE TRIGGER saldo_proveedor_down
            AFTER DELETE 
            ON `pedidos` FOR EACH ROW
            BEGIN 
                DECLARE id_proveedor int;
                DECLARE id_planta int;
                DECLARE monto float;
    
                set id_planta = OLD.planta_id;
                select `proveedor_id` into id_proveedor 
                    from `plantas` where `id`=id_planta;
                set monto = OLD.costo_galon * OLD.galones ;
    
                UPDATE `proveedores` set `deuda` = `deuda` - round( monto , 2)
                WHERE `id` = id_proveedor ;
            END;
        ');
        //UPDATE
        DB::unprepared('

        CREATE TRIGGER saldo_proveedor_edit
            AFTER UPDATE 
            ON `pedidos` FOR EACH ROW
            BEGIN 
                DECLARE id_proveedor int;
                DECLARE id_planta int;
                DECLARE monto float;
                IF (OLD.galones != NEW.galones or OLD.costo_galon != new.costo_galon)
                THEN
                    set id_planta = OLD.planta_id;
                    select `proveedor_id` into id_proveedor 
                        from `plantas` where `id`=id_planta;
                    set monto = round(new.costo_galon * new.galones ,2) - round(old.costo_galon * old.galones,2);
    
                    UPDATE proveedores set `deuda` = `deuda`  + round( monto , 2)
                        WHERE id = id_proveedor ;
                END IF;
            END;
        ');

        //SI SE AMORTIZA EL PEDIDO
        //AFTER INSERT 'pedido_proveedors' --falta


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `saldo_proveedor_up`');
        DB::unprepared('DROP TRIGGER IF EXISTS `saldo_proveedor_down`');
        DB::unprepared('DROP TRIGGER IF EXISTS `saldo_proveedor_edit`');        
    }
}
