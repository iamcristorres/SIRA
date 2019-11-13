<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class logro extends Model
{
    protected $table='logros';
    public $timestamps = false;
    protected $primaryKey = 'id_logro';
    protected $fillable=["id_logro","id_asignatura","PERIODO","TIPO_LOGRO","DESCRIPCION","PUESTO"];
}
