<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class diagnostico extends Model
{
    protected $table='diagnosticos';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $fillable=["ID","CODIGO_ESTUDIANTE","COD_DIAGNOSTICO","ANO","PERIODO","ASIGNATURA","DIAGNOSTICO","SEGUIMIENTO","FECHA_PUBLICACION"];


    public function asignatura(){
    	return $this->hasOne("App\asignatura","id","ASIGNATURA");
    }

}
