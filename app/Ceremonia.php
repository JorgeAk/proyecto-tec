<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ceremonia extends Model
{
    protected $table = 'ceremonias';
    protected $fillable =['nombre','descripcion','nc_alumno','fecha','hora','lugar','presidente','secretario','v_propietario','v_suplente'];
}
