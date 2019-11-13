<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class departamento extends Model
{
    protected $table='departamentos';
    public $timestamps = false;
    protected $fillable=["ID","NOMBRE_DEPARTAMENTO"];

}
