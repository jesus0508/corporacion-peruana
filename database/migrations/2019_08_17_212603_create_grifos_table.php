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
            $table->string('ruc')->nullable();
            $table->string('telefono')->nullable();
            $table->string('administrador');
            $table->string('dni')->nullable();           
            $table->float('stock');
            $table->string('correo_grifo')->nullable();
            $table->decimal('precio_galon', 9, 5);
            $table->string('direccion')->nullable();
            $table->string('zona');
            $table->string('distrito')->nullable();
            $table->integer('forma_pago');
            $table->string('persona_comision')->nullable();
            $table->string('correo_representante')->nullable();
            $table->string('nro_cuenta')->nullable();
            $table->string('cuenta_detraccion')->nullable();
            $table->string('utilidades')->nullable();
            $table->string('extraordinaria')->nullable();
            $table->integer('estado')->default(1);                 
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
