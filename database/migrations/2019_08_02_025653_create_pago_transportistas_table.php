<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoTransportistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_transportistas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_pago');
            $table->string('codigo_pago');
            $table->float('monto_total_pago');
            $table->float('pendiente_dejado');
            $table->string('observacion');
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
        Schema::dropIfExists('pago_transportistas');
    }
}
