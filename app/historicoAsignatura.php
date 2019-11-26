<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historicoAsignatura extends Model
{
    protected $table='historial_asignaturas';
    public $timestamps = false;
    protected $fillable=["ID","ID_ASIGNATURA","ID_AREA","NOMBRE_ASIGNATURA","ID_GRADO","ID_CURSO","IHS","PERIODO"];

    public function area(){
    	return $this->hasOne("App\historicoAreas","ID","ID_AREA");
    }
    


}
