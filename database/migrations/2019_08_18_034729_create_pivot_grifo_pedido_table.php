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
            $table->unsignedBigInteger('pedido_id')->nullable();
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->unsignedBigInteger('grifo_id')->nullable();
            $table->foreign('grifo_id')->references('id')->on('grifos');
            $table->integer('asignacion');
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

        Schema::dropIfExists('pedido_grifos');
    }
}
