<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asignatura extends Model
{
    protected $table='asignaturas';
    public $timestamps = false;
    protected $fillable=["id","id_area","NOMBRE_ASIGNATURA","id_docente","id_grado","id_curso","IHS","ANO"];

    public function docente(){
    	return $this->hasOne("App\docente","CODIGO","id_docente");
    }

    public function area(){
    	return $this->hasOne("App\area","id","id_area");
    }
    public function curso(){
    	return $this->hasOne("App\curso","id","id_curso");
    }
    public function grado(){
        return $this->hasOne("App\grado","id","id_grado");
    }



}
