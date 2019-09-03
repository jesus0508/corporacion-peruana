<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriaGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categoria_gastos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('subcategoria');
            $table->unsignedBigInteger('categoria_gasto_id');
            $table->foreign('categoria_gasto_id')->references('id')->on('categoria_gastos');           
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
        Schema::table('sub_categoria_gastos', function (Blueprint $table) {
            $table->dropForeign(['categoria_gasto_id']);            
        });
        Schema::dropIfExists('sub_categoria_gastos');
    }
}
