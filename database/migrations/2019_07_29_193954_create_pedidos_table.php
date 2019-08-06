<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nro_pedido');
            //$table->string('planta');
            $table->string('scop');
            //$table->date('fecha_despacho');
            $table->integer('galones');
            $table->integer('galones_distribuidos')->default(0);
            $table->decimal('costo_galon',9,5);
            $table->integer('estado')->default(1);
            $table->decimal('saldo',9,2)->nullable();
            //$table->string('nro_factura')->nullable();
            //$table->decimal('pago_acta',9,2)->nullable();
            //$table->date('fecha_pago')->nullable();
            $table->unsignedBigInteger('factura_proveedor_id')->nullable();
            $table->foreign('factura_proveedor_id')->references('id')->on('factura_proveedors');
            $table->unsignedBigInteger('vehiculo_id')->nullable();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->unsignedBigInteger('planta_id');
            $table->foreign('planta_id')->references('id')->on('plantas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['factura_proveedor_id']);
        });
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['vehiculo_id']);
        });
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['planta_id']);
        });

        Schema::dropIfExists('pedidos');
    }
}
