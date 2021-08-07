<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')
                ->on('producto')
                ->onDelete('restrict');
            $table->string('inicial')->default(0);
            $table->string('entradas')->nullable()->default(0);
            $table->string('salidas')->nullable()->default(0);
            $table->string('stock')->default(0);
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('almacen');
    }
}
