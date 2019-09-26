<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('monto_ingreso');
            $table->string('detalle')->nullable();
            $table->string('codigo_operacion')->nullable();
            $table->date('fecha_ingreso');
            $table->string('banco')->nullable();           
            $table->unsignedBigInteger('categoria_ingreso_id');
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
        Schema::dropIfExists('ingresos');
        Schema::table('ingresos', function (Blueprint $table) {
            $table->dropForeign(['categoria_ingreso_id']);                     
        });
    }
}
