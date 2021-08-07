<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('rfc')->nullable();
            $table->string('direccion')->nullable();
            $table->string('referencia')->nullable();
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
