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
            $table->string('codigo_operacion')->nullable();
            $table->float('monto_operacion');
            $table->float('saldo')->default(0);
            $table->string('banco');
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
        Schema::table('pago_clientes', function (Blueprint $table) {
            $table->dropForeign(['pedido_cliente_id']);
        });
        Schema::dropIfExists('pago_clientes');
    }
}
