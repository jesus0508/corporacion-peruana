<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoTransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_transportes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_reporte');
            $table->date('fecha_ingreso');
            $table->decimal('monto_ingreso',9,2);
            $table->string('descripcion')->default('Ingreso por Buses');
            $table->unsignedBigInteger('transporte_id');
            $table->foreign('transporte_id')
            ->references('id')->on('transportes');
            $table->unsignedBigInteger('categoria_ingreso_id')->default(3);
            $table->foreign('categoria_ingreso_id')
            ->references('id')->on('categoria_ingresos');
            $table->softDeletes(); 
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
        Schema::table('ingreso_transportes', function (Blueprint $table) {
            $table->dropForeign(['transporte_id']);
         });
        Schema::dropIfExists('ingreso_transportes');

    }
}
