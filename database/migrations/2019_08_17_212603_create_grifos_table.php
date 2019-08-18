<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrifosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grifos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razon_social');
            $table->string('ruc');
            $table->string('telefono')->nullable();
            $table->string('administrador');
            $table->integer('stock');
            $table->string('direccion');
            $table->string('distrito')->nullable();
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
        Schema::dropIfExists('grifos');
    }
}
