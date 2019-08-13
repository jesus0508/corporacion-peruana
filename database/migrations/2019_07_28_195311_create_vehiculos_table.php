<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('placa');
            $table->integer('capacidad');
            $table->string('detalle_compartimiento')->nullable();
            $table->unsignedBigInteger('transportista_id'); 
            $table->foreign('transportista_id')
                ->references('id')
                ->on('transportistas');
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
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->dropForeign(['transportista_id']);
        });
        Schema::dropIfExists('vehiculos');
    }
}
