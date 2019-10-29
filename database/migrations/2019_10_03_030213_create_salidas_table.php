<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('monto_egreso');
            $table->string('detalle')->nullable();
            $table->string('codigo_operacion')->nullable();
            $table->date('fecha_egreso')->nullable();
            $table->date('fecha_reporte'); 
            $table->string('nro_cheque')->nullable();
            $table->string('nro_comprobante')->nullable();           
            $table->string('banco')->nullable();
            $table->unsignedBigInteger('cuenta_id')->nullable();
            $table->foreign('cuenta_id')
            ->references('id')->on('cuentas');           
            $table->unsignedBigInteger('categoria_egreso_id');
            $table->foreign('categoria_egreso_id')
            ->references('id')->on('categoria_egresos');
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
        Schema::table('salidas', function (Blueprint $table) {
            $table->dropForeign(['cuenta_id','categoria_egreso_id']);
        });

        Schema::dropIfExists('salidas');
    }
}
