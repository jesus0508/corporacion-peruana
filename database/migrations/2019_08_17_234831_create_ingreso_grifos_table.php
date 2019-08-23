<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoGrifosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_grifos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('lectura_inicial');
            $table->float('lectura_final');
            $table->integer('calibracion');
            $table->decimal('precio_galon', 9, 5);
            $table->date('fecha_ingreso');
            $table->unsignedBigInteger('grifo_id');
            $table->foreign('grifo_id')->references('id')->on('grifos');
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
            $table->dropForeign(['grifo_id']);
        });
        Schema::dropIfExists('ingreso_grifos');
    }
}
