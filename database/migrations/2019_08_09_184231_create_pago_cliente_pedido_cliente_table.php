<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoClientePedidoClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_cliente_pedido_cliente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pago_cliente_id');
            $table->unsignedBigInteger('pedido_cliente_id');
            $table->foreign('pago_cliente_id')->references('id')->on('pago_clientes');
            $table->foreign('pedido_cliente_id')->references('id')->on('pedido_clientes');
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
        Schema::table('pago_cliente_pedido_cliente', function (Blueprint $table) {
            $table->dropForeign(['pago_cliente_id']);
            $table->dropForeign(['pedido_cliente_id']);
        });

        Schema::dropIfExists('pago_cliente_pedido_cliente');
    }
}
