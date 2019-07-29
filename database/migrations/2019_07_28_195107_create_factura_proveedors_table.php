<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_proveedors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nro_factura_proveedor');
            $table->decimal('monto_factura',9,2);
            $table->date('fecha_factura_proveedor');
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
        Schema::dropIfExists('factura_proveedors');
    }
}
