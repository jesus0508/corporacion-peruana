<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockGrifosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_grifos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('lectura_inicial');
            $table->float('lectura_final');
            $table->integer('calibracion')->nullable();
            $table->float('venta_soles');
            $table->decimal('precio_galon', 9, 5);
            $table->date('fecha_stock');
            $table->float('traspaso')->nullable();           
            $table->float('recepcion')->nullable();  
            $table->date('fecha_reporte')->nullable();
            $table->float('stock_grifo')->nullable();
            $table->float('stock_sistema')->nullable();

            $table->integer('horario_pbf')->nullable();
            $table->float('cantidad_pbf')->nullable();            
            $table->integer('horario_pecsa')->nullable();
            $table->float('cantidad_pecsa')->nullable();            
            $table->integer('horario_primax')->nullable();
            $table->float('cantidad_primax')->nullable();        

            $table->unsignedBigInteger('grifo_id');
            $table->foreign('grifo_id')->references('id')->on('grifos');            
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

        Schema::table('stock_grifos', function (Blueprint $table) {
            $table->dropForeign(['grifo_id']);
         });
        Schema::dropIfExists('stock_grifos');
    }
}
