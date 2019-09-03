<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('monto_egreso');
            $table->date('fecha_egreso');
            $table->unsignedBigInteger('grifo_id');
            $table->foreign('grifo_id')->references('id')->on('grifos');
            $table->unsignedBigInteger('concepto_gasto_id');
            $table->foreign('concepto_gasto_id')->references('id')->on('concepto_gastos');
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

        Schema::table('egresos', function (Blueprint $table) {
            $table->dropForeign(['grifo_id']);
            $table->dropForeign(['concepto_gasto_id']);            
        });

        Schema::dropIfExists('egresos');
    }
}
