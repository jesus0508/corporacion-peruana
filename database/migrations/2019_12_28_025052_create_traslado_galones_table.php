<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrasladoGalonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traslado_galones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('stock')->nullable();
            $table->float('nuevo_stock')->nullable();                                    
            $table->float('cantidad');
            $table->integer('horario');
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')
                    ->references('id')->on('clientes');
            $table->unsignedBigInteger('grifos_id')->nullable();
            $table->foreign('grifos_id')
                    ->references('id')->on('grifos');                 
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
        Schema::dropIfExists('traslado_galones');
    }
}
