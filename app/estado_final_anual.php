<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estado_final_anual extends Model
{
    protected $table='estado_final_anual';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $fillable=["ID","CODIGO","PERIODO","COD_GRADO","GRADO","COD_CURSO","ESTADO","GRADO_SIGUIENTE"];
}
