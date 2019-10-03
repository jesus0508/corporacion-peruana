<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depositos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('monto');
            $table->string('detalle')->nullable();
            $table->string('codigo_operacion')->nullable();
            $table->date('fecha_deposito')->nullable();;
            $table->date('fecha_reporte');            
            $table->string('banco')->nullable();           
            $table->unsignedBigInteger('cuenta_id');
            $table->foreign('cuenta_id')
            ->references('id')->on('cuentas');
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
        Schema::dropIfExists('depositos');
    }
}
