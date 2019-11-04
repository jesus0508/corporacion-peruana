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
            $table->integer('calibracion')->nullable();
            $table->float('monto_ingreso');
            $table->decimal('precio_galon', 9, 5);
            $table->date('fecha_ingreso');
            $table->date('fecha_reporte');
            $table->float('total_galones_factura')->nullable();
            $table->float('total_galones_boleta')->nullable();
            $table->string('facturacion')->nullable();
            $table->unsignedBigInteger('grifo_id');
            $table->foreign('grifo_id')->references('id')->on('grifos');
            $table->unsignedBigInteger('categoria_ingreso_id')->default(2);
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
        Schema::table('ingreso_grifos', function (Blueprint $table) {
            $table->dropForeign(['grifo_id']);
            $table->dropForeign(['categoria_ingreso_id']);
        });
        Schema::dropIfExists('ingreso_grifos');
    }
}
