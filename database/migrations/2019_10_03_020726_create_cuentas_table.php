<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_apertura')->nullable();
            $table->string('nro_cuenta');
            $table->float('fondo_actual');
            $table->string('tipo')->default('Soles');
            $table->integer('estado')->default(1);
            $table->unsignedBigInteger('banco_id');
            $table->foreign('banco_id')
            ->references('id')->on('bancos');          
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
        Schema::dropIfExists('cuentas');
        Schema::table('cuentas', function (Blueprint $table) {
            $table->dropForeign(['banco_id']);                     
        });
    }
}
