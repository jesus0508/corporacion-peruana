<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_operacion');
            $table->string('codigo_operacion');
            $table->float('monto_operacion');
            $table->string('banco');
            $table->integer('estado')->default(1);
            $table->unsignedBigInteger('categoria_ingreso_id')->default(1);
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
        Schema::dropIfExists('movimientos');
        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropForeign(['categoria_ingreso_id']);                     
        });
    }
}
