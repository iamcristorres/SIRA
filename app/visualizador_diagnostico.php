<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class visualizador_diagnostico extends Model
{
    protected $table='visualizador_diagnostico';
    public $timestamps = false;
    protected $fillable=["ID","ESTUDIANTE","COD_DIAG","VISTO","FECHA_VISTO","COMENTARIO_PADRE","COMENTARIO_ESTUDIANTE","COMENTARIO_DIRCURSO"];

}
