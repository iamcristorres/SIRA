<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grado extends Model
{
    protected $table='grados';
    public $timestamps = false;
    protected $fillable=["id","GRADO","GRADO_SIGUIENTE","EDUCACION","ANO"];
}
