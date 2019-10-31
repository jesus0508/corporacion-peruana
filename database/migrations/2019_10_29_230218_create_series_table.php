<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serie')->nullable();
            $table->integer('nro');
            $table->unsignedBigInteger('grifo_id')->nullable();
            $table->foreign('grifo_id')
            ->references('id')->on('grifos');
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
        Schema::table('series', function (Blueprint $table) {
            $table->dropForeign(['grifo_id']);
         });
        Schema::dropIfExists('series');
    }
}
