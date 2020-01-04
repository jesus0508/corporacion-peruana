<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balanceos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->float('cantidad');
            $table->float('grifo_sender_stock_nuevo');
            $table->float('grifo_receiver_stock_nuevo');
            $table->unsignedBigInteger('grifo_id_sender');
            $table->foreign('grifo_id_sender')->references('id')->on('grifos');
            $table->unsignedBigInteger('grifo_id_receiver');
            $table->foreign('grifo_id_receiver')->references('id')->on('grifos');
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
        Schema::table('balanceos', function (Blueprint $table) {
            $table->dropForeign(['grifo_id_sender']);
            $table->dropForeign(['grifo_id_receiver']);
         });
        Schema::dropIfExists('balanceos');
    }
}
