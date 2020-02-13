<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PagoGastosGerencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_gastos_gerencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('salida_id');
            $table->foreign('salida_id')->references('id')->on('salidas');
            $table->unsignedBigInteger('egreso_gerencia_id');
            $table->foreign('egreso_gerencia_id')->references('id')->on('egreso_gerencias');
            $table->float('asignacion',9,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('pago_gastos_gerencia', function (Blueprint $table) {
            $table->dropForeign(['salida_id','egreso_gerencia_id']);
        });

        Schema::dropIfExists('stock');
    }
}
