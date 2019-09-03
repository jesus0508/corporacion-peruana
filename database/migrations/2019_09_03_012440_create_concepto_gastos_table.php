<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptoGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepto_gastos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('concepto');
            $table->unsignedBigInteger('sub_categoria_gasto_id');
            $table->foreign('sub_categoria_gasto_id')->references('id')->on('sub_categoria_gastos');           
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
        Schema::table('concepto_gastos', function (Blueprint $table) {
            $table->dropForeign(['sub_categoria_gasto_id']);            
        });

        Schema::dropIfExists('concepto_gastos');
    }
}
