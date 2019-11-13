<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coddiagnostico extends Model
{
    protected $table='cod_diagnotico';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $fillable=["ID","NO_DIAG","FECHA_APERTURA","FECHA_CIERRE","FECHA_CORTE","ANO_ACTIVO","PERIODO"];

}
