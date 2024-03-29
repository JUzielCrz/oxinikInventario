<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('unidad_medida_base');
            $table->string('unidad_medida_secundaria')->nullable();
            $table->float('unidad_conversion')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('clave_sat')->nullable();
            $table->float('precio_compra');
            $table->float('precio_venta');
            $table->float('precio_minimo');
            $table->float('user_id')->nullable();
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
        Schema::dropIfExists('producto');
    }
}
