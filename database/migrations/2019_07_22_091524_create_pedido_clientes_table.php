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
            // 'nro_pedido','grifo','galones','horario_descarga', 'scop', 
            // 'nro_pedido','transportista' , 'planta' , 'detalle','fecha_pedido',
            // 'cod_osinergmin','cod_cliente','usuario_osinerming'
            $table->bigIncrements('id');
            $table->string('nro_pedido');
            $table->string('grifo');
            $table->integer('galones');
            $table->string('horario_descarga')->nullable();
            $table->string('scop');
            $table->string('transportista')->nullable();
            $table->string('planta');
            $table->string('observacion')->nullable();
            $table->date('fecha_pedido')->nullable();
            $table->string('cod_osinergmin')->nullable();
            $table->string('cod_cliente')->nullable();
            $table->string('usuario_osinerming')->nullable();
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
        Schema::dropIfExists('pedido_clientes');
    }
}
