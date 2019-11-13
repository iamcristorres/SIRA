<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class calificacion extends Model
{
    protected $table='calificaciones';
    public $timestamps = false;
    protected $primaryKey = 'CODIGO_ESTUDIANTE';
    protected $fillable=["id","CODIGO_ESTUDIANTE","id_asignatura","ANO_ACT","F1","P1","F2","P2","F3","P3","F4","P4"];

     public function asignatura(){
    	return $this->hasOne("App\asignatura","id","id_asignatura");
    }
}
