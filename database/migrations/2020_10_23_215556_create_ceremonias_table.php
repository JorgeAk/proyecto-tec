<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeremoniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ceremonias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('nc_alumno');
            $table->date('fecha');
            $table->time('hora');
            $table->string('lugar');
            $table->string('presidente');
            $table->string('secretario');
            $table->string('v_propietario');
            $table->string('v_suplente');
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
        Schema::dropIfExists('ceremonias');
    }
}
