<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotGrifoPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_grifos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->unsignedBigInteger('grifo_id');
            $table->foreign('grifo_id')->references('id')->on('grifos');
            $table->unsignedBigInteger('pago_transportista_id')->nullable();
            $table->foreign('pago_transportista_id')
                    ->references('id')->on('pago_transportistas');
            $table->integer('asignacion');
            $table->string('hora_descarga')->nullable();  
            $table->date('fecha_descarga')->nullable();            
            $table->integer('faltante')->nullable();
            $table->string('grifero')->nullable();
            $table->string('descripcion')->default('Faltante en grifo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido_grifos', function (Blueprint $table) {
            $table->dropForeign(['pedido_id']);
        });

        Schema::table('pedido_grifos', function (Blueprint $table) {
            $table->dropForeign(['grifo_id']);
        });

        Schema::table('pedido_grifos', function (Blueprint $table) {
            $table->dropForeign(['pago_transportista_id']);
        });
        
        Schema::dropIfExists('pedido_grifos');
    }
}
