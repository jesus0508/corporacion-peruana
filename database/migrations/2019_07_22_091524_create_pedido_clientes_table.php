<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nro_factura')->nullable();
            $table->integer('galones');
            $table->integer('galones_asignados')->default(0);
            $table->integer('estado')->default(1);
            $table->decimal('precio_galon', 9, 5);
            $table->float('saldo');
            $table->date('fecha_descarga')->nullable();
            $table->string('horario_descarga')->nullable();
            $table->string('fecha_confirmacion')->nullable();
            $table->text('observacion')->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido_clientes', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']);
        });
        Schema::dropIfExists('pedido_clientes');
    }
}
