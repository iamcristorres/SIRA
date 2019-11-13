<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class municipio extends Model
{
    protected $table='municipios';
    public $timestamps = false;
    protected $fillable=["ID","NOMBRE_MUNICIPIO","ID_DEPARTAMENTO"];

}
