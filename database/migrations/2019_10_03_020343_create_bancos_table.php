<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBancosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bancos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banco');
            $table->string('abreviacion');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')
            ->references('id')->on('empresas');
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
        Schema::dropIfExists('bancos');
        Schema::table('bancos', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']);                     
        });
    }
}
