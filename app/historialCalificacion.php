<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historialCalificacion extends Model
{
    protected $table='historial_calificaciones';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $fillable=["ID","CODIGO_ESTUDIANTE","ID_ASIGNATURA","PERIODO","DEF","TF"];

     public function asignatura(){
    	return $this->hasOne("App\historicoAsignatura","ID","ID_ASIGNATURA");
    }
}
