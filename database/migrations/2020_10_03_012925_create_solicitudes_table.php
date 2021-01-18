<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('n_control');
            $table->string('p_nombre');
            $table->string('s_nombre');
            $table->string('a_paterno');
            $table->string('a_materno');
            $table->string('municipio');
            $table->string('cp');
            $table->string('entidad_f');
            $table->string('telefono');
            $table->string('celular');
            $table->string('p_correo');
            $table->string('s_correo');
            $table->string('carrera');
            $table->integer('plan');
            $table->string('f_ingreso');
            $table->string('f_egreso');
            $table->integer('op_titulacion');
            $table->string('n_proyecto');
            $table->integer('asesor');
            $table->integer('presidente');
            $table->integer('secretario');
            $table->integer('v_propietario');
            $table->integer('v_suplente');
            $table->integer('primer_revisor');
            $table->integer('segundo_revisor');
            $table->integer('tercer_revisor');
            $table->integer('cuarto_revisor');
            $table->integer('s_estatus');
            $table->string('proy_archivo');
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
        Schema::dropIfExists('solicitudes');
    }
}
