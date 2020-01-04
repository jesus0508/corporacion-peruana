<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ruc',11)->unique();
            $table->string('razon_social');
            $table->string('cargo')->nullable();
            $table->string('representante')->nullable();  
            $table->string('dni')->nullable();
            $table->string('correo_cliente')->nullable();
            $table->decimal('precio_galon', 9, 5);
            $table->bigInteger('linea_credito'); 
            $table->string('distrito');                                    
            $table->string('actividad_economica')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion');
            $table->string('forma_pago');
            $table->string('persona_comision')->nullable();
            $table->string('correo_representante')->nullable();
            $table->string('nro_cuenta')->nullable();
            $table->string('cuenta_detraccion')->nullable();
            $table->string('utilidades');
            $table->string('extraordinaria');                        
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
