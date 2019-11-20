<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historicoAreas extends Model
{
    protected $table='historial_areas';
    public $timestamps = false;
    protected $fillable=["ID","AREA","PERIODO"];

}
