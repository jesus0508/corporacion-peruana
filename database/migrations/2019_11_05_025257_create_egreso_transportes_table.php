<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEgresoTransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egreso_transportes', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->date('fecha_reporte');
            $table->date('fecha_egreso');
            $table->integer('tipo_comprobante');
            $table->string('nro_comprobante');
            $table->string('descripcion')->nullable();
            $table->decimal('monto_egreso',9,2);
            $table->unsignedBigInteger('transporte_id');
            $table->foreign('transporte_id')
            ->references('id')->on('transportes');
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
        Schema::table('egreso_transportes', function (Blueprint $table) {
            $table->dropForeign(['transporte_id']);
         });
        Schema::dropIfExists('egreso_transportes');
    }
}
