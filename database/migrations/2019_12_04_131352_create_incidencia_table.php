<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->date('fecha');
            $table->string('clase');
            $table->string('equipo');
            $table->string('descripcion');
            $table->string('hora');
            $table->string('comentario');
            $table->string('estado');
            $table->string('email');
            $table->string('otro')->nullable();
            $table->string('archivo')->default('default.png')->nullable();
            $table->unsignedBigInteger('User_id');
            $table->foreign('User_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('incidencias');
    }
}
