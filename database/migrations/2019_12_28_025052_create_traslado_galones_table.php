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
            $table->integer('tipo');
            $table->float('stock');
            $table->float('nuevo_stock');                                
            $table->float('cantidad');
            $table->string('horario')->nullable();
            $table->date('fecha');
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')
                    ->references('id')->on('clientes');
            $table->unsignedBigInteger('grifo_id')->nullable();
            $table->foreign('grifo_id')
                    ->references('id')->on('grifos');                 
            // $table->unsignedBigInteger('stock_grifo_id');
            // $table->foreign('stock_grifo_id')->references('id')->on('stock_grifos');
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
        Schema::table('traslado_galones', function (Blueprint $table) {
            $table->dropForeign(['proveedor_id']);                     
        });
        Schema::dropIfExists('traslado_galones');
    }
}
