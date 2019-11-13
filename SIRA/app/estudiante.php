<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class estudiante extends Authenticatable
{
    protected $table='estudiantes';
    public $timestamps = false;
    protected $primaryKey = 'CODIGO';
    protected $fillable=["CODIGO","APELLIDO1","APELLIDO2","NOMBRES","password","GRADO","CURSO","ESTADO_DEL_ESTUDIANTE","TIPO_DE_ESTUDIANTE","TIPO_DE_DOCUMENTO","NUMERO_DE_DOCUMENTO","GENERO","CORREO_ELECTRONICO","FECHA_EXPEDICION_DE_DOCUMENTO","DEPARTAMENTO_DE_EXPEDICION_DE_DOCUMENTO","MUNICIPIO_DE_EXPEDICION_DE_DOCUMENTO","FECHA_DE_NACIMIENTO","DEPARTAMENTO_DE_NACIMIENTO","MUNICIPIO_DE_NACIMIENTO","DEPARTAMENTO_DE_RESIDENCIA","MUNICIPIO_DE_RESIDENCIA","BARRIO_DE_RESIDENCIA","DIRECCION_DE_RESIDENCIA","TELEFONO_DE_RESIDENCIA","CELULAR_DE_RESIDENCIA","SISBEN","PUNTAJE_SISBEN","NOMBRE_EPS","ESTRATO","TIPO_DE_SANGRE"];

    public function calificacion(){
    	return $this->hasOne("App\calificacion","CODIGO_ESTUDIANTE","CODIGO");
    }
}
