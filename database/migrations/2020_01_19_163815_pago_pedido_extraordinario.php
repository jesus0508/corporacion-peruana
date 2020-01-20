<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PagoPedidoExtraordinario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_proveedor_extraordinario', function (Blueprint $table) {   
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pedido_extraordinario_id');
            $table->foreign('pedido_extraordinario_id')->references('id')->on('pedidos');
            $table->unsignedBigInteger('pedido_id');      
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->float('asignacion');
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
        Schema::dropIfExists('pedidos');
    }
}
