<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $fillable = ['n_control','p_nombre','s_nombre','a_paterno','a_materno','municipio','cp','entidad_f','telefono','celular','p_correo','s_correo','carrera','plan','f_ingreso','f_egreso','op_titulacion','n_proyecto','asesor','presidente','secretario','v_propietario','v_suplente','primer_revisor','segundo_revisor','tercer_revisor','cuarto_revisor','s_estatus','proy_archivo'];
}
