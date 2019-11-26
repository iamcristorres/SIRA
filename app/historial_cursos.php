<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historial_cursos extends Model
{
    protected $table='historial_cursos';
    public $timestamps = false;
    protected $fillable=["ID","ID_CURSO","ID_GRADO","PERIODO","CURSO"];

}
