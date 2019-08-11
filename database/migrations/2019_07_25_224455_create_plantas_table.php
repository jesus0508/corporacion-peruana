<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('planta');
            $table->string('direccion_planta')->nullable();
            $table->string('celular_planta')->nullable();
            $table->unsignedBigInteger('proveedor_id'); 
            $table->foreign('proveedor_id')
                ->references('id')
                ->on('proveedores');
                //->onDelete('cascade')
                //->onUpdate('cascade');
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
        Schema::dropIfExists('plantas');
    }
}
