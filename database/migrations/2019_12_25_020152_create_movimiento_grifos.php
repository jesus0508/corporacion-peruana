<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoGrifos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_grifos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->date('fecha_operacion');
                $table->date('fecha_reporte');
                $table->string('codigo_operacion');
                $table->float('monto_operacion');
                $table->string('banco');
                $table->unsignedBigInteger('grifo_id');
                $table->foreign('grifo_id')->references('id')->on('grifos');
                $table->integer('estado')->default(1);
                $table->unsignedBigInteger('categoria_ingreso_id')->default(4);
                $table->foreign('categoria_ingreso_id')
                ->references('id')->on('categoria_ingresos');
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
        Schema::table('movimiento_grifos', function (Blueprint $table) {
            $table->dropForeign(['categoria_ingreso_id','grifo_id']);                     
        });
        Schema::dropIfExists('movimiento_grifos');
    }
}
