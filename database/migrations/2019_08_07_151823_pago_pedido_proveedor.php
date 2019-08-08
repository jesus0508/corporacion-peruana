<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PagoPedidoProveedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_pedido_proveedors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pago_proveedor_id')->nullable();
            $table->foreign('pago_proveedor_id')->references('id')->on('pago_proveedors');
            $table->unsignedBigInteger('pedido_id')->nullable();
            $table->foreign('pedido_id')->references('id')->on('pedidos');
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
        Schema::table('pago_pedido_proveedors', function (Blueprint $table) {
            $table->dropForeign(['pedido_id']);
        });

        Schema::table('pago_pedido_proveedors', function (Blueprint $table) {
            $table->dropForeign(['pago_proveedor_id']);
        });

        Schema::dropIfExists('pago_pedido_proveedors');
    }
}
