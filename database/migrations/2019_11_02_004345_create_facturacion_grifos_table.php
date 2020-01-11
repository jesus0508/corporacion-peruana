<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturacionGrifosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturacion_grifos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('venta_factura',9,2)->nullable();
            $table->decimal('venta_boleta',9,2)->nullable();
            $table->decimal('precio_venta',9,2);  
            $table->string('numero_factura')->nullable();
            $table->date('fecha_facturacion');
            $table->unsignedBigInteger('serie_id');
            $table->foreign('serie_id')
            ->references('id')->on('series');           
            $table->unsignedBigInteger('grifo_id');
            $table->foreign('grifo_id')
            ->references('id')->on('grifos');
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
        Schema::table('facturacion_grifos', function (Blueprint $table) {
            $table->dropForeign(['grifo_id']);
         });
        Schema::dropIfExists('facturacion_grifos');
    }
}
