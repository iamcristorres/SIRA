<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class portal extends Model
{
    protected $table='configuration_portals';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable=["id","PUBLICACION_CALIFICACIONES","EP_PER1","EP_PER2","EP_PER3","EP_PER4","EP_PER5","EP_PER6","A_P1","A_P2","A_P3","A_P4","A_P5","A_P6","C_P1","C_P2","C_P3","C_P4","C_P5","C_P6"];

}
