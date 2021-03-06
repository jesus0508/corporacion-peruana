<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoProveedorClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_proveedor_clientes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('pedido_cliente_id')->nullable();
            $table->foreign('pedido_cliente_id')
                ->references('id')->on('pedido_clientes');

            $table->unsignedBigInteger('pedido_id')->nullable();
            $table->foreign('pedido_id')->references('id')->on('pedidos');

            $table->unsignedBigInteger('pago_transportista_id')->nullable();
            $table->foreign('pago_transportista_id')
                    ->references('id')->on('pago_transportistas');
            $table->decimal('precio_galon_faltante', 9, 5)->nullable(); 
            $table->integer('asignacion');
            $table->decimal('faltante')->nullable();
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

        Schema::table('pedido_proveedor_clientes', function (Blueprint $table) {
            $table->dropForeign(['pedido_id']);
        });

        Schema::table('pedido_proveedor_clientes', function (Blueprint $table) {
            $table->dropForeign(['pedido_cliente_id']);
        });

        Schema::table('pedido_grifos', function (Blueprint $table) {
            $table->dropForeign(['pago_transportista_id']);
        });
        
        Schema::dropIfExists('pedido_proveedor_clientes');

        
    }
}
