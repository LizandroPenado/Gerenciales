<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioZonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_zonas', function (Blueprint $table) {
            $table->bigIncrements('id');
           // $table->string('zona');
            //$table->integer('cantidad'); 
            //$table->string('nombreEspecie');
            $table->string('codigo_inventario');
            $table->string('nombre_inventario');
            $table->string('descripcion_inventario');
            $table->unsignedBigInteger('zona_id');
            $table->foreign('zona_id')->references('id')->on('zonas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('inventario_zonas');
    }
}
