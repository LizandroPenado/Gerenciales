<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobradorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobradors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('sexo');
            $table->string('telefono');
            $table->string('fecha_nacimiento');
            $table->string('correo_electronico');
            $table->string('dui');
            $table->string('nit');
            $table->integer('estado')->default(1);
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
        Schema::dropIfExists('cobradors');
    }
}
