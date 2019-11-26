<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class curso extends Model
{
    protected $table='cursos';
    public $timestamps = false;
    protected $fillable=["id","id_grado","CURSO","DIR_CURSO","JORNADA","HORARIO","PERIODO"];

    public function docente(){
    	return $this->hasOne("App\docente","CODIGO","DIR_CURSO");
    }

    public function grado(){
    	return $this->hasOne("App\grado","id","id_grado");
    }

}
