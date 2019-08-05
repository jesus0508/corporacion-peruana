<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_operacion');
            $table->string('codigo_operacion');
            $table->float('monto_operacion');
            $table->string('banco');
            $table->unsignedBigInteger('pedido_cliente_id');
            $table->timestamps();
            $table->foreign('pedido_cliente_id')->references('id')->on('pedido_clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pago_clientes', function (Blueprint $table) {
            $table->dropForeign(['pedido_cliente_id']);
        });
        Schema::dropIfExists('pago_clientes');
    }
}
