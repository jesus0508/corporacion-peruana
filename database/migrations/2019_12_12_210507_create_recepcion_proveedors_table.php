<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecepcionProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcion_proveedors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('cantidad');
            $table->integer('horario');
            $table->unsignedBigInteger('stock_grifo_id');
            $table->foreign('stock_grifo_id')->references('id')->on('stock_grifos');
            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');           
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
        Schema::table('recepcion_proveedors', function (Blueprint $table) {
            $table->dropForeign(['stock_grifo_id','proveedor_id']);
         });

        Schema::dropIfExists('recepcion_proveedors');
    }
}
