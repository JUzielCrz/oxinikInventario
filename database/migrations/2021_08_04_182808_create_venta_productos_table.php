<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id');
            $table->foreign('venta_id')->references('id')
                ->on('venta')
                ->onDelete('restrict');
                $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')
                ->on('producto')
                ->onDelete('restrict');
            $table->integer('cantidad');
            $table->float('subtotal');
            $table->float('iva');
            $table->float('total');
            $table->enum('facturado',['SI', 'NO']);
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
        Schema::dropIfExists('venta_productos');
    }
}
