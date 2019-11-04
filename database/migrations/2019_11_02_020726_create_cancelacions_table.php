<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCancelacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('monto');
            $table->string('nro_operacion');
            $table->date('fecha');
            $table->unsignedBigInteger('facturacion_grifo_id');
            $table->foreign('facturacion_grifo_id')
            ->references('id')->on('facturacion_grifos');
            $table->softDeletes(); 
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
        Schema::table('cancelacions', function (Blueprint $table) {
            $table->dropForeign(['facturacion_grifo_id']);
         });
        Schema::dropIfExists('cancelacions');
    }
}
